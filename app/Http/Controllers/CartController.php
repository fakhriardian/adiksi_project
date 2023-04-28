<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $addData = [
            'user_email' => Auth()->user()->email,
            'image' => $request->get('item-image'),
            'name' => $request->get('item-name'),
            'qty' => $request->get('item-qty'),
            'price' => ($request->get('item-price') * $request->get('item-qty')),
            'option' => $request->get('option'),
        ];
        // dd($request['item-name']);

        // name = 'choklat'
        // $addData['name'] = 'stroberi';

        $countData = DB::table('carts')
            ->where('status', '0')
            ->where('name', $request->get('item-name'))
            ->where('option', $request->get('option'))
            ->where('user_email', Auth()->User()->email)->get();
        // dd($countData);

        // dd($countData);
        
        if (count($countData) == 1) {
            $currentQty = DB::table('carts')->select('qty')
            ->where('status', '0')
            ->where('name', $request->get('item-name'))
            ->where('option', $request->get('option'))
            ->where('user_email', Auth()->User()->email)
            ->get()[0]->qty;
            $currentPrice = DB::table('carts')->select('price')
            ->where('status', '0')
            ->where('name', $request->get('item-name'))
            ->where('option', $request->get('option'))
            ->where('user_email', Auth()->User()->email)
            ->get()[0]->price;
            // dd($currentPrice, $currentQty);
            if ($addData['option'] != $countData[0]->option) {
                Cart::create($addData);
            } else {
                DB::table('carts')
                    ->where('name', $request->get('item-name'))
                    ->where('option', $request->get('option'))
                    ->where('user_email', Auth()->User()->email)
                    ->update([
                    'qty' => $currentQty + $request->get('item-qty'),
                    'price' => $currentPrice + ($request->get('item-price') * $request->get('item-qty')),
                ]);
            }
        } else {
            Cart::create($addData);
        }

        return redirect()->back();
    }

        public function destroy(Cart $cart, $id)
    {
        // $item = Item::findOrFail($item->id);
        Cart::where('id', $id)->delete();
        if ($cart->image && file_exists(storage_path('store-image/' . $cart->image))) {
            Storage::delete('store-image/' . $cart->image);
        }

        $cart->delete();

        return redirect()->back();
    }
}
