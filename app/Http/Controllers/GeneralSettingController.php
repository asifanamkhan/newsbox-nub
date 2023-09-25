<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GeneralSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $general_settings = DB::table('general_settings')->first();
            return view('back-end.settings.general.index', compact('general_settings'));
        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'site_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ], []);

        try {

            $general_settings = DB::table('general_settings')
                ->count();

            if ($general_settings > 0) {
                $value = 'update';
            } else {
                $value = 'insert';
            }

            DB::table('general_settings')->$value([
                'site_name' => $request->site_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'created_by' => Auth::id(),
                'created_at' => Carbon::now(),
            ]);

            return redirect()->route('general-settings.index')
                ->with('success', 'Added Successfully');
        } catch (\Exception $exception) {

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}

