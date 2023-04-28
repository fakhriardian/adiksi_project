<?php

namespace App\Http\Controllers;

use App\Models\LandingPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = LandingPage::find(1)->toArray();
        return view('admin.landingpage.index', compact('index'));
        // return view('admin.landingPage.index');
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
     * @param  \App\Models\LandingPage  $landingPage
     * @return \Illuminate\Http\Response
     */
    public function show(LandingPage $landingPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LandingPage  $landingPage
     * @return \Illuminate\Http\Response
     */
    public function edit(LandingPage $landingPage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LandingPage  $landingPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LandingPage $landingPage)
    {
        $request->validate([
            'hero_caption' => 'required|max:1000',
            'hero_head' => 'required|max:1000',
            'hero_desc' => 'required|max:1000',
            'card_head' => 'required|max:1000',
            'card_desc' => 'required|max:1000',
            'card_quote' => 'required|max:1000',
            'hl_head' => 'required|max:1000',
            'hl_desc' => 'required|max:1000',
            'hl_capt1' => 'required|max:1000',
            'hl_capt2' => 'required|max:1000',
            'hl_capt3' => 'required|max:1000',
            'hl_capt4' => 'required|max:1000',
            'mt_head' => 'required|max:1000',
            'mt_desc' => 'required|max:1000',
        ]);
        if ($request->hasFile('hero_image')) {
            //upload new image
            $image = $request->file('hero_image');
            $image->storeAs('public/store-image/', $image->hashName());

            //delete old image
            Storage::delete('public/store-image/' . $landingPage->hero_image);

            //update post with new image
            LandingPage::where('id', 1)->update([
                'hero_image'   => $image->hashName(),
                'hero_caption' => $request->hero_caption,
                'hero_head'    => $request->hero_head,
                'hero_desc'    => $request->hero_desc,
                'card_head'    => $request->card_head,
                'card_desc'    => $request->card_desc,
                'card_quote' => $request->card_quote,
                'hl_head'    => $request->hl_head,
                'hl_desc'    => $request->hl_desc,
                'hl_capt1'    => $request->hl_capt1,
                'hl_capt2'    => $request->hl_capt2,
                'hl_capt3'    => $request->hl_capt3,
                'hl_capt4'    => $request->hl_capt4,
                'mt_head'    => $request->mt_head,
                'mt_desc'    => $request->mt_desc,
            ]);
        }

        if ($request->hasFile('card_image')) {

            //upload new image
            $image = $request->file('card_image');
            $image->storeAs('public/store-image/', $image->hashName());

            //delete old image
            Storage::delete('public/store-image/' . $landingPage->card_image);

            //update post with new image
            LandingPage::where('id', 1)->update([
                'card_image'   => $image->hashName(),
                'hero_caption' => $request->hero_caption,
                'hero_head'    => $request->hero_head,
                'hero_desc'    => $request->hero_desc,
                'card_head'    => $request->card_head,
                'card_desc'    => $request->card_desc,
                'card_quote' => $request->card_quote,
                'hl_head'    => $request->hl_head,
                'hl_desc'    => $request->hl_desc,
                'hl_capt1'    => $request->hl_capt1,
                'hl_capt2'    => $request->hl_capt2,
                'hl_capt3'    => $request->hl_capt3,
                'hl_capt4'    => $request->hl_capt4,
                'mt_head'    => $request->mt_head,
                'mt_desc'    => $request->mt_desc,
            ]);
        }

        if ($request->hasFile('hl_image1')) {

            //upload new image
            $image = $request->file('hl_image1');
            $image->storeAs('public/store-image/', $image->hashName());

            //delete old image
            Storage::delete('public/store-image/' . $landingPage->hl_image1);

            //update post with new image
            LandingPage::where('id', 1)->update([
                'hl_image1'  => $image->hashName(),
                'hero_caption' => $request->hero_caption,
                'hero_head'    => $request->hero_head,
                'hero_desc'    => $request->hero_desc,
                'card_head'    => $request->card_head,
                'card_desc'    => $request->card_desc,
                'card_quote' => $request->card_quote,
                'hl_head'    => $request->hl_head,
                'hl_desc'    => $request->hl_desc,
                'hl_capt1'    => $request->hl_capt1,
                'hl_capt2'    => $request->hl_capt2,
                'hl_capt3'    => $request->hl_capt3,
                'hl_capt4'    => $request->hl_capt4,
                'mt_head'    => $request->mt_head,
                'mt_desc'    => $request->mt_desc,
            ]);
        } 
        if ($request->hasFile('hl_image2')) {

            //upload new image
            $image = $request->file('hl_image2');
            $image->storeAs('public/store-image/', $image->hashName());

            //delete old image
            Storage::delete('public/store-image/' . $landingPage->hl_image2);

            //update post with new image
            LandingPage::where('id', 1)->update([
                'hl_image2'  => $image->hashName(),
                'hero_caption' => $request->hero_caption,
                'hero_head'    => $request->hero_head,
                'hero_desc'    => $request->hero_desc,
                'card_head'    => $request->card_head,
                'card_desc'    => $request->card_desc,
                'card_quote' => $request->card_quote,
                'hl_head'    => $request->hl_head,
                'hl_desc'    => $request->hl_desc,
                'hl_capt1'    => $request->hl_capt1,
                'hl_capt2'    => $request->hl_capt2,
                'hl_capt3'    => $request->hl_capt3,
                'hl_capt4'    => $request->hl_capt4,
                'mt_head'    => $request->mt_head,
                'mt_desc'    => $request->mt_desc,
            ]);
        } 
        if ($request->hasFile('hl_image3')) {

            //upload new image
            $image = $request->file('hl_image3');
            $image->storeAs('public/store-image/', $image->hashName());

            //delete old image
            Storage::delete('public/store-image/' . $landingPage->hl_image3);

            //update post with new image
            LandingPage::where('id', 1)->update([
                'hl_image3'  => $image->hashName(),
                'hero_caption' => $request->hero_caption,
                'hero_head'    => $request->hero_head,
                'hero_desc'    => $request->hero_desc,
                'card_head'    => $request->card_head,
                'card_desc'    => $request->card_desc,
                'card_quote' => $request->card_quote,
                'hl_head'    => $request->hl_head,
                'hl_desc'    => $request->hl_desc,
                'hl_capt1'    => $request->hl_capt1,
                'hl_capt2'    => $request->hl_capt2,
                'hl_capt3'    => $request->hl_capt3,
                'hl_capt4'    => $request->hl_capt4,
                'mt_head'    => $request->mt_head,
                'mt_desc'    => $request->mt_desc,
            ]);
        } 
        if ($request->hasFile('hl_image4')) {

            //upload new image
            $image = $request->file('hl_image4');
            $image->storeAs('public/store-image/', $image->hashName());

            //delete old image
            Storage::delete('public/store-image/' . $landingPage->hl_image4);

            //update post with new image
            LandingPage::where('id', 1)->update([
                'hl_image4'  => $image->hashName(),
                'hero_caption' => $request->hero_caption,
                'hero_head'    => $request->hero_head,
                'hero_desc'    => $request->hero_desc,
                'card_head'    => $request->card_head,
                'card_desc'    => $request->card_desc,
                'card_quote' => $request->card_quote,
                'hl_head'    => $request->hl_head,
                'hl_desc'    => $request->hl_desc,
                'hl_capt1'    => $request->hl_capt1,
                'hl_capt2'    => $request->hl_capt2,
                'hl_capt3'    => $request->hl_capt3,
                'hl_capt4'    => $request->hl_capt4,
                'mt_head'    => $request->mt_head,
                'mt_desc'    => $request->mt_desc,
            ]);
        } 
        if ($request->hasFile('mt_image')) {

            //upload new image
            $image = $request->file('mt_image');
            $image->storeAs('public/store-image/', $image->hashName());

            //delete old image
            Storage::delete('public/store-image/' . $landingPage->mt_image);

            //update post with new image
            LandingPage::where('id', 1)->update([
                'mt_image'  => $image->hashName(),
                'hero_caption' => $request->hero_caption,
                'hero_head'    => $request->hero_head,
                'hero_desc'    => $request->hero_desc,
                'card_head'    => $request->card_head,
                'card_desc'    => $request->card_desc,
                'card_quote' => $request->card_quote,
                'hl_head'    => $request->hl_head,
                'hl_desc'    => $request->hl_desc,
                'hl_capt1'    => $request->hl_capt1,
                'hl_capt2'    => $request->hl_capt2,
                'hl_capt3'    => $request->hl_capt3,
                'hl_capt4'    => $request->hl_capt4,
                'mt_head'    => $request->mt_head,
                'mt_desc'    => $request->mt_desc,
            ]);
        } 
        ////////////////////////////////////////////////////
        if ($request->hasFile('image1')) {

            //upload new image
            $image = $request->file('image1');
            $image->storeAs('public/store-image/', $image->hashName());

            //delete old image
            Storage::delete('public/store-image/' . $landingPage->image1);

            //update post with new image
            LandingPage::where('id', 1)->update([
                'image1'  => $image->hashName(),
                'hero_caption' => $request->hero_caption,
                'hero_head'    => $request->hero_head,
                'hero_desc'    => $request->hero_desc,
                'card_head'    => $request->card_head,
                'card_desc'    => $request->card_desc,
                'card_quote' => $request->card_quote,
                'hl_head'    => $request->hl_head,
                'hl_desc'    => $request->hl_desc,
                'hl_capt1'    => $request->hl_capt1,
                'hl_capt2'    => $request->hl_capt2,
                'hl_capt3'    => $request->hl_capt3,
                'hl_capt4'    => $request->hl_capt4,
                'mt_head'    => $request->mt_head,
                'mt_desc'    => $request->mt_desc,
            ]);
        }
        if ($request->hasFile('image2')) {

            //upload new image
            $image = $request->file('image2');
            $image->storeAs('public/store-image/', $image->hashName());

            //delete old image
            Storage::delete('public/store-image/' . $landingPage->image2);

            //update post with new image
            LandingPage::where('id', 1)->update([
                'image2'  => $image->hashName(),
                'hero_caption' => $request->hero_caption,
                'hero_head'    => $request->hero_head,
                'hero_desc'    => $request->hero_desc,
                'card_head'    => $request->card_head,
                'card_desc'    => $request->card_desc,
                'card_quote' => $request->card_quote,
                'hl_head'    => $request->hl_head,
                'hl_desc'    => $request->hl_desc,
                'hl_capt1'    => $request->hl_capt1,
                'hl_capt2'    => $request->hl_capt2,
                'hl_capt3'    => $request->hl_capt3,
                'hl_capt4'    => $request->hl_capt4,
                'mt_head'    => $request->mt_head,
                'mt_desc'    => $request->mt_desc,
            ]);
        }
        if ($request->hasFile('image3')) {

            //upload new image
            $image = $request->file('image3');
            $image->storeAs('public/store-image/', $image->hashName());

            //delete old image
            Storage::delete('public/store-image/' . $landingPage->image3);

            //update post with new image
            LandingPage::where('id', 1)->update([
                'image3'  => $image->hashName(),
                'hero_caption' => $request->hero_caption,
                'hero_head'    => $request->hero_head,
                'hero_desc'    => $request->hero_desc,
                'card_head'    => $request->card_head,
                'card_desc'    => $request->card_desc,
                'card_quote' => $request->card_quote,
                'hl_head'    => $request->hl_head,
                'hl_desc'    => $request->hl_desc,
                'hl_capt1'    => $request->hl_capt1,
                'hl_capt2'    => $request->hl_capt2,
                'hl_capt3'    => $request->hl_capt3,
                'hl_capt4'    => $request->hl_capt4,
                'mt_head'    => $request->mt_head,
                'mt_desc'    => $request->mt_desc,
            ]);
        }
        if ($request->hasFile('image4')) {

            //upload new image
            $image = $request->file('image4');
            $image->storeAs('public/store-image/', $image->hashName());

            //delete old image
            Storage::delete('public/store-image/' . $landingPage->image4);

            //update post with new image
            LandingPage::where('id', 1)->update([
                'image4'  => $image->hashName(),
                'hero_caption' => $request->hero_caption,
                'hero_head'    => $request->hero_head,
                'hero_desc'    => $request->hero_desc,
                'card_head'    => $request->card_head,
                'card_desc'    => $request->card_desc,
                'card_quote' => $request->card_quote,
                'hl_head'    => $request->hl_head,
                'hl_desc'    => $request->hl_desc,
                'hl_capt1'    => $request->hl_capt1,
                'hl_capt2'    => $request->hl_capt2,
                'hl_capt3'    => $request->hl_capt3,
                'hl_capt4'    => $request->hl_capt4,
                'mt_head'    => $request->mt_head,
                'mt_desc'    => $request->mt_desc,
            ]);
        }else {
            //update post without image
            LandingPage::where('id', 1)->update([
                'hero_caption' => $request->hero_caption,
                'hero_head'    => $request->hero_head,
                'hero_desc'    => $request->hero_desc,
                'card_head'    => $request->card_head,
                'card_desc'    => $request->card_desc,
                'card_quote' => $request->card_quote,
                'hl_head'    => $request->hl_head,
                'hl_desc'    => $request->hl_desc,
                'hl_capt1'    => $request->hl_capt1,
                'hl_capt2'    => $request->hl_capt2,
                'hl_capt3'    => $request->hl_capt3,
                'hl_capt4'    => $request->hl_capt4,
                'mt_head'    => $request->mt_head,
                'mt_desc'    => $request->mt_desc,
            ]);
        }

        return redirect()->route('landingpage.index')->with(['success' => 'Data has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LandingPage  $landingPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(LandingPage $landingPage)
    {
        //
    }
}
