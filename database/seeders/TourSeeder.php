<?php

namespace Database\Seeders;

use App\Models\Tour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Tour::factory(10)->create();

        foreach (Tour::all() as $tour)
        {
            $inn = \App\Models\Inn::all()->take(rand(1,15))->pluck('id');
            $tour->inns()->attach($inn);
            
            $travel = \App\Models\Travel::all()->take(rand(1,15))->pluck('id');
            $tour->travels()->attach($travel);
        }
    }
}
