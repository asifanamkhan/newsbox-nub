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
            $social_links = DB::table('social_links')
                ->orderBy('id', 'ASC')
                ->get();

            return view('back-end.settings.social-link.index', compact('social_links'));
        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required',

        ], []);
        try {
            DB::table('social_links')
                ->where('id', $request->id)
                ->update([
                    'link' => $request->link,
                    'num_of_follower' => $request->num_of_follower ?? 0,
                    'updated_by' => Auth::id(),
                    'updated_at' => Carbon::now(),
                ]);

            return redirect()->route('social-link.index')
                ->with('success', 'Added Successfully');
        } catch (\Exception $exception) {

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

}
