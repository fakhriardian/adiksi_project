<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $publish = Item::with('categories')->where('draft', '0')->where('name','like','%' . $request->get('search_publish') . '%')->orderBy('created_at', 'DESC')->paginate(6);
        $draft = Item::with('categories')->where('draft','1')->where('name','like','%' . $request->get('search_draft') . '%')->orderBy('created_at', 'DESC')->paginate(6);

        return view('admin.menu.index', compact('publish', 'draft'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu.create', [
            'category' => Categories::all()
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
        $input = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif|max:20048',
            'name' => 'required|max:500',
            'desc' => 'required|max:500',
            'price' => 'required|max:500',
            'categories_id' => 'required|max:500',
        ]);

        $image = $request->file('image');
        $image->storeAs('public/store-image/', $image->hashName());
        $input['image'] = $image->hashName();

        Item::create($input);
        return redirect()->route('menu.index')->with(['success' => 'Data succesfully created!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item, $id)
    {
        $categories = Categories::all();
        $item = Item::where('id', $id)->first();

        return view('admin.menu.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item, $id)
    {
        $update = $this->validate($request, [
            'name' => 'required|max:500',
            'desc' => 'required|max:500',
            'price' => 'required|max:500',
            'categories_id' => 'required|max:500',
        ]);

        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/store-image/', $image->hashName());

            //delete old image
            Storage::delete('public/store-image/' . $item->image);

            //update post with new image
            $update['image'] = $image->hashName();
        }

        Item::where('id', $id)->update($update);

        return redirect()->route('menu.index')->with(['success' => 'Data succesfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item, $id)
    {
        // $item = Item::findOrFail($item->id);
        Item::where('id', $id)->delete();
        if ($item->image && file_exists(storage_path('store-image/' . $item->image))) {
            Storage::delete('store-image/' . $item->image);
        }

        $item->delete();

        return redirect()->route('menu.index')->with(['success' => 'Data has been deleted!']);
    }
    public function draft($id)
    {
        Item::where('id', $id)->where('draft','0')->update([
            'draft' => '1',
        ]);

        return redirect()->route('menu.index')->with(['success' => 'Data has been moved to draft!']);
    }
    public function publish($id)
    {
        Item::where('id', $id)->where('draft','1')->update([
            'draft' => '0',
        ]);

        return redirect()->route('menu.index')->with(['success' => 'Data has been published!']);
    }
    
    // public function add(Request $request)
    // {
    //     $id = $request->get('id');
    //     $name = $request->get('name');
    //     $price = $request->get('price');
    //     $quantity = $request->get('quantity');

    //     $cart = session()->get('cart', []);

    //     if(isset($cart[$id])) {
    //         $cart[$id]['quantity'] += $quantity;
    //     } else {
    //         $cart[$id] = [
    //             'name' => $name,
    //             'price' => $price,
    //             'quantity' => $quantity
    //         ];
    //     }
        
    //     session()->put('cart', $cart);
        
    //     return redirect()->back()->with('success', 'Item added to cart successfully!');
    // }
}