<?php

namespace App\Http\Controllers;

use App\Models\Inn;
use App\Models\Tour;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function innAdd (Tour $tour, Request $request)
    {
        $attr = $request->validate([
            'inn' => 'required',
        ]);
        $tour->inns()->attach($attr);
        return back();
    }

    public function innRemove (Inn $inns, Tour $tour)
    {      
        $data = Inn::find($inns->id);
        $data->tours()->detach($tour->id);
        return back();
    }
}
