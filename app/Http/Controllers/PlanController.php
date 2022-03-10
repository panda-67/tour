<?php

namespace App\Http\Controllers;

use App\Models\Inn;
use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function innAdd(Tour $tour, Request $request)
    {
        $attr = $request->validate([
            'inn' => 'required',
        ]);
        $tour->inns()->attach($attr);
        return back();
    }

    public function innRemove(Inn $inns, Tour $tour)
    {
        $data = Inn::find($inns->id);
        $data->tours()->detach($tour->id);
        return back();
    }

    public function travelAdd(Tour $tour, Request $request)
    {
        $attr = $request->validate([
            'travel' => 'required',
        ]);
        $tour->travels()->attach($attr);
        return back();
    }

    public function travelRemove(Travel $travels, Tour $tour)
    {
        $data = Travel::find($travels->id);
        $data->tours()->detach($tour->id);
        return back();
    }
}
