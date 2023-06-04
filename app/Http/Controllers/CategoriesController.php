<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = Categories::orderBy('created_at', 'DESC')->paginate(6);
        $categories = Categories::all();

        return view('admin.category.index', compact('index','categories'));
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
            'icon' => 'required|max:15000',
            'name' => 'required|max:500',
        ]);

        Categories::create($input);
        return redirect()->route('category.index')->with(['success' => 'Data succesfully created!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = $this->validate($request, [
            'name' => 'required|max:500',
            'icon' => 'required|max:1000',
        ]);

        Categories::where('id', $id)->update($update);

        return redirect()->route('category.index')->with(['success' => 'Data succesfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $categories, $id)
    {
         // $item = Item::findOrFail($item->id);
         Categories::where('id', $id)->delete();
 
         $categories->delete();
 
         return redirect()->route('category.index')->with(['success' => 'Data has been deleted!']);
    }
}
