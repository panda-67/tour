<?php

namespace App\Http\Controllers;

use App\Models\Inn;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Pivot;
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

        // $tours = Tour::paginate(5)->through(fn($tour) => [
        //     'id' => $tour->id,
        //     'name' => $tour->name,
        // ]);

        return Inertia::render('Tour/Index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Tour/Create', [
            'inns' => Inn::all(),
        ]);
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
        ]);
        $attr['user_id'] = Auth::user()->id;
        Tour::create($attr);
        return to_route('dashboard')->with('message', 'Tour add successfuly!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        $allInn = Inn::orderBY('name')->get();

        $inns = Inn::whereHas('tours', function (Builder $query) use ($tour) {
            $query->where('tour_id', $tour->id);
        })->orderBy("name", "asc")->get();

        return Inertia::render('Tour/Show', compact('tour', 'allInn', 'inns'));
    }

    public function plan(Tour $tour, Request $request)
    {
        $attr = $request->validate([
            'ainn' => 'required',
        ]);
        $tour->inns()->attach($attr);
        return back();
    }

    public function remove_plan(Inn $inns, Tour $tour, )
    {      
        $data = Inn::findOrFail($inns->id);
        $data->tours()->detach($tour->id);        
        return back();
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
