<?php

namespace App\Http\Controllers;

use App\Models\About;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{
    public function index()
    {
        try {
            $abouts = DB::table('abouts')->first();
            return view('back-end.settings.about-us.index', compact('abouts'));
        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'about' => 'required',
        ], []);
        try {

            $abouts = DB::table('abouts')
                ->count();

            if ($abouts > 0) {
                $value = 'update';
            } else {
                $value = 'insert';
            }

            DB::table('abouts')->$value([
                'about' => $request->about,
                'status' => 1,
                'created_by' => Auth::id(),
                'created_at' => Carbon::now(),
            ]);

            return redirect()->route('about-us.index')
                ->with('success', 'Added Successfully');
        } catch (\Exception $exception) {

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
