<?php

namespace App\Http\Controllers\news;

use App\Http\Controllers\Controller;
use App\Models\NewsType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;

class NewsTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = DB::table('news_types')
                    ->orderBy('id', 'DESC')
                    ->get();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function ($data) {
                        return $data->name;
                    })
                    ->addColumn('action', function ($data) {
                        return '<div class="" role="group">
                                    <a id=""
                                        href="' . route('newstype.edit', $data->id) . '" class="btn btn-sm btn-success" style="cursor:pointer"
                                        title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a class="btn btn-sm btn-danger" style="cursor:pointer"
                                       href="' . route('newstype.destroy', [$data->id]) . '"
                                       onclick="showDeleteConfirm(' . $data->id . ')" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>';
                    })
                    ->rawColumns(['name','action'])
                    ->make(true);
            }
            return view('back-end.news.newstype.index');
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
            return view('back-end.news.newstype.create');
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
            'name' => 'required',
        ], []);
        try {
            DB::table('news_types')->insert([
                'name' => $request->name,
                'created_by' => Auth::id(),
                'created_at' => Carbon::now(),
            ]);

            return redirect()->route('newstype.index')
                ->with('success', 'Added Successfully');
        } catch (\Exception $exception) {

            return redirect()->back()->with('error', $exception->getMessage());
        }


    }

    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $newstype = DB::table('news_types')
            ->where('id', $id)
            ->first();
        try {
            return view('back-end.news.newstype.edit', compact('newstype'));
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
            'name' => 'required',
        ], []);
        try {
            DB::table('news_types')
                ->where('id', $id)
                ->update([
                    'name' => $request->name,
                    'updated_by' => Auth::id(),
                    'updated_at' => Carbon::now(),
                ]);

            return redirect()->route('newstype.index')
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
            $important_link = DB::table('news_types')
                ->where('id', $id)
                ->delete();

            return redirect()->route('newstype.index')
                ->with('error', 'Deleted Successfully');

        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }
}
