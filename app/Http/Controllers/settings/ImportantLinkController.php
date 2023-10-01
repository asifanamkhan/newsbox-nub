<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\ImportantLink;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;

class ImportantLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = DB::table('important_links')
                    ->orderBy('id', 'DESC')
                    ->get();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('title', function ($data) {
                        return $data->title;
                    })
                    ->addColumn('link', function ($data) {
                        return $data->link;
                    })
                    ->addColumn('action', function ($data) {
                        return '<div class="" role="group">
                                    <a id=""
                                        href="' . route('important-links.edit', $data->id) . '" class="btn btn-sm btn-success" style="cursor:pointer"
                                        title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    
                                    <a class="btn btn-sm btn-danger" style="cursor:pointer" 
                                       href="' . route('important-links.destroy', [$data->id]) . '" 
                                       onclick="showDeleteConfirm(' . $data->id . ')" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>';
                    })
                    ->rawColumns(['image', 'title', 'news', 'status', 'action'])
                    ->make(true);
            }
            return view('back-end.settings.important-links.index');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('back-end.settings.important-links.create');
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
            'title' => 'required',
        ], []);
        try {
            DB::table('important_links')->insert([
                'link' => $request->link,
                'title' => $request->title,
                'status' => 1,
                'created_by' => Auth::id(),
                'created_at' => Carbon::now(),
            ]);

            return redirect()->route('important-links.index')
                ->with('success', 'Added Successfully');
        } catch (\Exception $exception) {

            return redirect()->back()->with('error', $exception->getMessage());
        }


    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $important_link = DB::table('important_links')
            ->where('id', $id)
            ->first();
        try {
            return view('back-end.settings.important-links.edit', compact('important_link'));
        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'link' => 'required',
            'title' => 'required',
        ], []);
        try {
            DB::table('important_links')
                ->where('id', $id)
                ->update([
                    'link' => $request->link,
                    'title' => $request->title,
                    'updated_by' => Auth::id(),
                    'updated_at' => Carbon::now(),
                ]);

            return redirect()->route('important-links.index')
                ->with('success', 'Updated Successfully');
        } catch (\Exception $exception) {

            return redirect()->back()->with('error', $exception->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::table('important_links')
                ->where('id', $id)
                ->delete();

            return redirect()->route('important-links.index')
                ->with('error', 'Deleted Successfully');

        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }
}
