<?php

namespace App\Http\Controllers;

use App\Models\Inn;
use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours = Tour::with('users:id,name')->paginate(10);

        return Inertia::render('Tour/Index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Tour/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);
        $attr['user_id'] = Auth::user()->id;
        Tour::create($attr);

        return back()->with('message', 'Tour add successfuly!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        $selectInns = Inn::orderBY('name')->get();

        $inns = Inn::whereHas('tours', function (Builder $query) use ($tour) {
            $query->where('tour_id', $tour->id);
        })->orderBy("name", "asc")->get();

        $sumInns = Inn::whereHas('tours', function (Builder $query) use ($tour) {
            $query->where('tour_id', $tour->id);
        })->sum('price');

        $selectTravels = Travel::orderBY('name')->get();

        $travels = Travel::whereHas('tours', function (Builder $query) use ($tour) {
            $query->where('tour_id', $tour->id);
        })->orderBy("name", "asc")->get();

        $sumTravels = Travel::whereHas('tours', function (Builder $query) use ($tour) {
            $query->where('tour_id', $tour->id);
        })->sum('price');

        $sumTour = $sumInns + $sumTravels;

        return Inertia::render('Tour/Show', compact(
            'tour',
            'sumTour',
            'selectInns',
            'inns',
            'sumInns',
            'selectTravels',
            'travels',
            'sumTravels'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function edit(Tour $tour)
    {
        return Inertia::render('Tour/Edit', compact('tour'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tour $tour)
    {
        $attr = $request->validate([
            'name' => 'required',
        ]);
        $attr['user_id'] = Auth::user()->id;
        // dd($attr);
        Tour::where('id', $tour->id)->update($attr);
        return to_route('dashboard')->with('message', 'Tour update successfuly!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tour $tour)
    {
        Tour::destroy($tour->id);
        return to_route('dashboard')
            ->withSuccess(__('Tour deleted successfully.'));
    }
}
