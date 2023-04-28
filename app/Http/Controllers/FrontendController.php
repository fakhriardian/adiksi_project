<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Categories;
use App\Models\LandingPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Socmed;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        $index = LandingPage::all();
        $contact = Socmed::all();
        return view('frontend.index', compact('index','contact'));
    }
    public function menu(Request $request)
    {
        $index = LandingPage::all();
        $hero = LandingPage::get()->first();
        $categories = Categories::with('item')->get();
        $contact = Socmed::all();

        return view('frontend.menu', compact('categories','index','hero','contact'));
    }
    public function lokasi(Request $request)
    {
        $location = Location::all();
        $contact = Socmed::all();
        return view('frontend.lokasi', compact('location','contact'));
    }
    public function contact(Request $request)
    {
        $index = LandingPage::get()->first();
        $contact = Socmed::all();
        return view('frontend.kontak', compact('index','contact'));
    }
}
