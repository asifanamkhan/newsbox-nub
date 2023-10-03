<?php

namespace App\Http\Controllers\settings;

use App\Helper\SocialMedia;
use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SocialLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $social_links = SocialMedia::getName();
            $social_links_data = DB::table('news_categories')
                ->orderBy('id', 'DESC')
                ->get();
            return view('back-end.settings.social-link.index', compact('social_links','social_links_data'));
        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->name);
        $request->validate([
            'link' => 'required',
            'num_of_follower' => 'required',

        ], []);
        try {
            DB::table('social_links')
                ->where('name', $request->name)
                ->update([
                    'name' => $request->name,
                    'link' => $request->link,
                    'num_of_follower' => $request->num_of_follower,
                    'created_by'=> Auth::id(),
                    'updated_by' => Auth::id(),
                    'updated_at' => Carbon::now(),
                ]);

            return redirect()->route('social-link.index')
                ->with('success', 'Added Successfully');
        } catch (\Exception $exception) {

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SocialLink $socialLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SocialLink $socialLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SocialLink $socialLink)
    {
//        dd($request);
//
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialLink $socialLink)
    {
        //
    }
}
