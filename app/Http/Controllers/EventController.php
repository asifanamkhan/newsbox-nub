<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;
use DataTables;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = DB::table('events')
                    ->orderBy('id', 'DESC')
                    ->get();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function ($data) {
                        return '<a target="_blank" href="' . asset($data->image) . '">
                                   <img class="image" style="width:60px; height: 40px" src="' . asset($data->image) . '"/>
                                </a>';
                    })
                    ->addColumn('title', function ($data) {
                        return $data->title;
                    })
                    ->addColumn('status', function ($data) {
                        if ($data->status == 1) {
                            return "<select style='width: 80%' id='status-$data->id' onchange='statusChange([$data->id])' class='form-control'>
                                            <option selected  value='1' >Active</option>
                                            <option  value='0'>In active</option>
                                        </select>";
                        } else {
                            return "<select style='width: 80%' id='status-$data->id' onchange='statusChange([$data->id])' class='form-control'>
                                            <option  value='1' >Active</option>
                                            <option selected  value='0'>In active</option>
                                        </select>";
                        }


                    })
                    ->addColumn('action', function ($data) {
                        return '<div class="" role="group">
                                    <a id=""
                                        href="' . route('events.show', $data->id) . '" class="btn btn-sm btn-primary" style="cursor:pointer"
                                        title="View">
                                        <i class="fa fa-info-circle"></i>
                                    </a>
                                    <a id=""
                                        href="' . route('events.edit', $data->id) . '" class="btn btn-sm btn-success" style="cursor:pointer"
                                        title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a class="btn btn-sm btn-danger" style="cursor:pointer"
                                       href="' . route('events.destroy', [$data->id]) . '"
                                       onclick="showDeleteConfirm(' . $data->id . ')" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>';
                    })
                    ->rawColumns(['image', 'title', 'status', 'action'])
                    ->make(true);
            }
            return view('back-end.events.index');
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
            return view('back-end.events.create');
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
            'description' => 'required',
            'image' => 'required',
            // 'title'=>'required'
        ], []);
        try {

            if ($request->image) {
                $position = strpos($request->image, ';');
                $sub = substr($request->image, 0, $position);
                $ext = explode('/', $sub)[1];
                $image = time() . '.' . $ext;
                $img = Image::make($request->image);
                $upload_path = 'public/images/events/';
                $image_url = $upload_path . $image;
                $img->resize(700, 435);
                $img->save($image_url);
            } else {
                $image_url = 'public/image/no_image.jpg';
            }

            DB::table('events')->insert([
                'description' => $request->description,
                'image' => $image_url,
                'title' => $request->title,
                'status' => 0,
                'created_by' => Auth::id(),
                'created_at' => Carbon::now(),
            ]);

            return redirect()->route('events.index')
                ->with('success', 'Added Successfully');

        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }


    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $event = DB::table('events')
                ->where('id', $id)
                ->first();

            return view('back-end.events.show', compact('event'));
        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $event = DB::table('events')
                ->where('id', $id)
                ->first();

            return view('back-end.events.edit', compact('event'));
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
            'description' => 'required',
        ], []);
        try {

            if ($request->image) {
                $position = strpos($request->image, ';');
                $sub = substr($request->image, 0, $position);
                $ext = explode('/', $sub)[1];
                $image = time() . '.' . $ext;
                $img = Image::make($request->image);
                $upload_path = 'public/images/events/';
                $image_url = $upload_path . $image;
                $img->resize(700, 435);
                $img->save($image_url);
            } else {
                $image_url = $request->old_image;
            }

            DB::table('events')
                ->where('id', $id)
                ->update([
                    'description' => $request->description,
                    'image' => $image_url,
                    'title' => $request->title,
                    'status' => 0,
                    'created_by' => Auth::id(),
                    'created_at' => Carbon::now(),
                ]);

            return redirect()->route('events.index')
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
            DB::table('events')
                ->where('id', $id)
                ->delete();

            return redirect()->route('events.index')
                ->with('error', 'Deleted Successfully');

        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }

    public function events_status_change(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required',
        ], []);

        try {
            if ($request->status == 1) {
                $slides = DB::table('events')
                    ->where('status', 1)
                    ->count();

                if ($slides >= 3) {
                    return 0;
                }
            }

            DB::table('events')
                ->where('id', $request->id)
                ->update([
                    'status' => $request->status
                ]);

            return 1;


        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }
}
