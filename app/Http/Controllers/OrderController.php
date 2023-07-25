<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        return view('frontend.pesan');
    }
    public function checkout(Request $request)
    {
        $name = [];
        $price = [];
        $qty = [];
        $option = [];
        $email = Auth()->User()->email;

        $countData = Cart::where('user_email', $email)->where('status', 0)->latest()->value('id');
        // dd($countData);

        for ($i = 0; $i <= $countData; $i++) {
            if ($request->get('name-' . $i)) {
                array_push($name, $request->get('name-' . $i));
            }
            if ($request->get('price-' . $i)) {
                array_push($price, $request->get('price-' . $i));
            }
            if ($request->get('qty-' . $i)) {
                array_push($qty, $request->get('qty-' . $i));
            }
            if ($request->get('option-' . $i)) {
                array_push($option, $request->get('option-' . $i));
            }
        }
        $getTotal = $request->get('total');
        $total = (int) $getTotal;
        $getNumber = $request->get('tableNumber');
        $number = (int) $getNumber;
        $addData = [
            'user_email' => Auth()->User()->email,
            'user_name' => Auth()->User()->name,
            'total' => $total,
            'tableNumber' => $number,
        ];
        $countOrder = Order::where('order_id')->where('user_email',Auth()->User()->email)->get();
        // dd($countOrder);
        if (count($countOrder) == 1) {
            $update = $this->validate($request, [
                'tableNumber' => 'required|max:500',
            ]);
            DB::table('orders')->where('order_id')->where('user_email', Auth()->User()->email)
            ->update($update);
        }else{
            Order::create($addData);
        }
        // dd($request, $i);
        // $order = Order::create($request->all());

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        //generate unique order_Id
        $generate_id = rand();
        while (Cart::where('order_id', $generate_id)->exists()) {
            $generate_id = rand();
        }
        
        $params = array(
            'transaction_details' => array(
                'order_id' => $generate_id,
                'gross_amount' => $total,
            ),
            'customer_details' => array(
                'first_name' => Auth()->user()->name,
                'email' => Auth()->user()->email,
            ),
        );
        $order_id = $params['transaction_details']['order_id'];
        $order = Cart::where('user_email', Auth()->User()->email)->get();
        for ($i = 0; $i < count($order); $i++) {
            $order[$i]->where('status',0)
            ->where('user_email', Auth()->User()->email)
            ->update(['order_id' => $order_id]);
        }

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        // dd($snapToken);

        $get = Order::latest('created_at')->get()[0];

        return view('frontend.checkout', [
            'name' => $name,
            'price' => $price,
            'qty' => $qty,
            'option' => $option,
            'total' => $total,
            'number' => $number,
            'snapToken' => $snapToken,
            'order_id' => $order_id,
            'get' => $get
        ]);
    }
    public function callback()
    {
        $order = Cart::where('user_email', Auth()->User()->email)->get();
        for ($i = 0; $i < count($order); $i++) {
            $order[$i]->update(['status' => '1']);
        }
        $order_id = Cart::orderBy('updated_at', 'desc')->value('order_id');
        
        $tableNumber = Order::where('user_email', Auth()->User()->email)
        ->orderBy('created_at','DESC')->value('tableNumber');

        $order = Order::where('status','unpaid')
        ->where('tableNumber', $tableNumber)
        ->where('user_email', Auth()->User()->email)->update([
            'order_id' => $order_id,
            'status' => 'paid',
            'paymentMethod' => 'E-Payment'
        ]);
        return $order_id;
    }
    // public function casheer()
    // {
    //     $order = Cart::where('user_email', Auth()->User()->email)->get();
    //     for ($i = 0; $i < count($order); $i++) {
    //         $order[$i]->update(['status' => '1']);
    //     }
    //     // dd($order);
    //     $tableNumber = Order::where('user_email', Auth()->User()->email)
    //     ->orderBy('created_at','DESC')->value('tableNumber');

    //     $order = Order::where('status','unpaid')
    //     ->where('tableNumber', $tableNumber)
    //     ->where('user_email', Auth()->User()->email)->update([
    //         'status' => 'paid'
    //     ]);
    //     return redirect()->back();
    // }
    public function invoice($order_id)
    {
        $orders = Order::with('carts')
        ->where('order_id', $order_id)
        ->where('user_email', Auth()->User()->email)
        ->where('status', 'paid')->get();
        $carts = Cart::with('order')
        ->where('order_id', $order_id)
        ->where('user_email', Auth()->User()->email)
        ->where('status', '1')->get();

        return view('frontend.invoice',compact('orders','carts'));
    }

    // back from checkout page
    public function destroy(Order $order, $get)
    {
        $order->where('created_at', $get)->delete();

        return redirect()->route('items.category');
    }
    public function cashPayment(Request $request, $order_id)
    {
        $cashier = $request->get('cashier');
        Order::where('order_id', $order_id)
        ->update([
            'cashier' => $cashier,
            'status' => 'paid',
            'active' => '1'
        ]);
        return redirect()->back();
    }
    public function ePayment(Request $request, $order_id)
    {
        $cashier = $request->get('cashier');
        Order::where('order_id', $order_id)
        ->update([
            'cashier' => $cashier,
            'active' => '1'
        ]);
        return redirect()->back();
    }
    public function timeline(Request $request, $order_id)
    {
        $timeline = $request->get('timeline');
        Order::where('order_id', $order_id)
        ->update([
            'timelines_id' => $timeline,
        ]);
        return redirect()->back();
    }
    public function timelineKasir(Request $request, $order_id)
    {
        $getStatus = Order::where('order_id', $order_id)->value('status');
        if ($getStatus == 'unpaid') {
            $timeline = $request->get('timeline');
            $tunai = $request->get('tunai');
            $change = $request->get('change');
            Order::where('order_id', $order_id)
            ->update([
                'timelines_id' => $timeline,
                'status' => 'paid',
                'tunai' => $tunai,
                'change' => $change
            ]);
        } else {
            $timeline = $request->get('timeline');
            Order::where('order_id', $order_id)
            ->update([
                'timelines_id' => $timeline,
                'status' => 'paid',
            ]);
        }
        
        return redirect()->back();
    }
    public function getNotifications()
    {
        $notifications = Order::orderBy('created_at', 'desc')->take(5)->get();

        return response()->json($notifications);
    }
}
