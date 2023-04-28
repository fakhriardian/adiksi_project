<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = Location::orderBy('created_at', 'DESC')->paginate(8);
        return view('admin.location.index', compact('index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'store' => 'required|max:500',
            'embed' => 'required|max:500',
        ]);

        Location::create($input);
        return redirect()->route('location.index')->with(['success' => 'Data has been updated']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        $this->validate($request, [
            'store' => 'required|max:500',
            'embed' => 'required|max:500',
        ]);

        $location->update([
            'store'        => $request->store,
            'embed'       => $request->embed
        ]);

        return redirect()->route('location.index')->with(['success' => 'Data has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $location = Location::findOrFail($location->id);
        $location->delete();

        return redirect()->route('location.index')->with(['success' => 'Data has been deleted']);
        // return redirect()->route('owners.index')->with('success','location Has Been Deleted!');
    }
}
