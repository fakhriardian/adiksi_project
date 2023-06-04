<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\Order;
use App\Models\Socmed;
use App\Models\Worker;
use App\Models\Timeline;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreWorkerRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function order(Request $request)
    {
        $categories = Categories::all();
        $contact = Socmed::all();
        $countDraft = Item::where('draft','1')->get();
        $selectedCategories = $request->input('categories', []);
        $carts = Cart::where('user_email', Auth()->User()->email)
            ->where('status', 0)
            ->get();
        // $cartDatas = Cart::select('*')
        //     ->where('user_email', Auth()->user()->email)
        //     ->where('status', 0)
        //     ->get();
        // dd($carts);
        $total = 0;
        for ($i = 0; $i < count($carts); $i++) {
            $total += $carts[$i]->price;
        }

        $draft = Item::where('draft','1')->get();

        $items = Item::where('draft', '0')->where('name','like','%' . $request->get('search') . '%')->when($selectedCategories, function ($query) use ($selectedCategories) {
            $query->whereHas('categories', function ($query) use ($selectedCategories) {
                $query->whereIn('id', $selectedCategories);
            });
        })->get();

        return view('frontend.order', compact('items','categories','carts','selectedCategories', 'total','countDraft','draft','contact'));
    }
    public function history(Request $request)
    {
        $contact = Socmed::all();
        $order = Order::where('user_email', Auth()->User()->email)->where('order_id','like','%' . $request->get('search') . '%')->orderBy('updated_at', 'DESC')->paginate(6);
        return view('frontend.orderHistory', compact('order','contact'));
    }
    public function activeOrder(Request $request) 
    {
        $order = Order::with('timelines')->where('order_id','like','%' . $request->get('search') . '%')->orderBy('updated_at', 'DESC')->paginate(6);
        $workers = Worker::all();
        $timelines = Timeline::all();
        $carts = Cart::with('order')
        ->where('status', '1')->get();
        return view('admin.order.index', compact('order','workers','carts','timelines'));
    }
    public function confirm(Request $request, $order_id)
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
            'paymentMethod' => 'Cash'
        ]);
        $orders = Order::with('carts')
        ->where('order_id', $order_id)
        ->where('user_email', Auth()->User()->email)
        ->where('status', 'unpaid')->get();
        return view('frontend.casheerPayment', compact('orders'));
    }

    public function workers()
    {
        $index = Worker::orderBy('created_at', 'DESC')->paginate(6);
        return view('admin.workers.index', compact('index'));
    }
    public function store(Request $request, StoreWorkerRequest $StoreWorkerRequest)
    {
        $input = $request->validate([
            'name' => 'required|max:500',
            'age' => 'required|max:500',
        ]);

        $image = $request->file('image');
        $image->storeAs('public/store-image/', $image->hashName());
        $input['image'] = $image->hashName();
        Worker::create($input);

        return redirect()->back()->with(['success' => 'New worker has been created!']);
    }
    public function update(Request $request, Worker $worker, $id)
    {
        $update = $this->validate($request, [
            'name' => 'required|max:500',
            'age' => 'required|max:500',
        ]);

        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/store-image/', $image->hashName());

            //delete old image
            Storage::delete('public/store-image/' . $worker->image);

            //update post with new image
            $update['image'] = $image->hashName();
        }
        Worker::where('id', $id)->update($update);

        return redirect()->back()->with(['success' => 'Worker data has been updated!']);
    }
    public function destroy(Worker $worker, $id)
    {
        Worker::where('id', $id)->delete();
        if ($worker->image && file_exists(storage_path(('store-image/' . $worker->image)))){
            Storage::delete('storage-image/'. $worker->image);
        }

        $worker->delete();    
        return redirect()->back()->with(['success' => 'Worker has been deleted!' ]);
    }
    public function meeting()
    {
        return view('frontend.meeting');
    }
}
