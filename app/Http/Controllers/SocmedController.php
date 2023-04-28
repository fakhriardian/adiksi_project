<?php

namespace App\Http\Controllers;

use App\Models\Socmed;
use Illuminate\Http\Request;

class SocmedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = Socmed::where('id', 1)->get();
        return view('admin.socmed.index', compact('index'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Socmed  $socmed
     * @return \Illuminate\Http\Response
     */
    public function show(Socmed $socmed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Socmed  $socmed
     * @return \Illuminate\Http\Response
     */
    public function edit(Socmed $socmed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Socmed  $socmed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Socmed $socmed)
    {
        Socmed::where('id', 1)->update([
            'insta' => $request->insta,
            'tiktok' => $request->tiktok,
            'telp' => $request->telp
        ]);

        return redirect()->back()->with(['success' => 'Data has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Socmed  $socmed
     * @return \Illuminate\Http\Response
     */
    public function destroy(Socmed $socmed)
    {
        //
    }
}
