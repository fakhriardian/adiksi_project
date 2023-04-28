<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|max:500',
            'email' => 'required|max:500',
            'subject' => 'required|max:500',
            'message' => 'required|max:2000',
        ]);
        // dd($input);

        Contact::create($input);
        return redirect()->back()->with(['success' => 'Pesan berhasil dikirim!']);
    }
    public function message(Request $request)
    {
        $index = Contact::orderBy('created_at', 'DESC')->paginate(8);
        return view('admin.message.index', compact('index'));
    }
}
