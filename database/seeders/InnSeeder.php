<?php

namespace Database\Seeders;

use App\Models\Inn;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Inn::factory(10)->create();

        foreach (Inn::all() as $tour)
        {
            $inns = \App\Models\Tour::all()->take(5)->pluck('id');
            $tour->tours()->attach($inns);
        }
    }
}
