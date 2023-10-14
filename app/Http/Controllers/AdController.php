<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Helper\ImageHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;
use DataTables;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = DB::table('ads')
                    ->orderBy('id', 'DESC')
                    ->get();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('title', function ($data) {
                        return $data->title;

                    })
                    ->addColumn('description', function ($data) {
                        return $data->description;
                    })
                    ->addColumn('link', function ($data) {
                        return $data->link;
                    })
                    ->addColumn('image', function ($data) {
                        return '<a target="_blank" href="' . asset($data->image) . '">
                                   <img class="image" style="width:60px; height: 40px" src="' . asset($data->image) . '"/>
                                </a>';
                    })
                    ->addColumn('status', function ($data) {
                        if ($data->status == 1) {
                            return "<select id='status-$data->id' onchange='statusChange([$data->id])' class='form-control'>
                                            <option selected  value='1' >Active</option>
                                            <option  value='0'>In active</option>
                                        </select>";
                        } else {
                            return "<select id='status-$data->id' onchange='statusChange([$data->id])' class='form-control'>
                                            <option  value='1' >Active</option>
                                            <option selected  value='0'>In active</option>
                                        </select>";
                        }

                    })
                    ->addColumn('action', function ($data) {
                        return '<div class="" role="group">
                                    <a id=""
                                        href="' . route('ads.edit', $data->id) . '" class="btn btn-sm btn-success" style="cursor:pointer"
                                        title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a class="btn btn-sm btn-danger" style="cursor:pointer"
                                       href="' . route('ads.destroy', [$data->id]) . '"
                                       onclick="showDeleteConfirm(' . $data->id . ')" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>';
                    })
                    ->rawColumns(['image','title','link', 'description', 'status', 'action'])
                    ->make(true);
            }
            return view('back-end.ads.index');
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
            return view('back-end.ads.create');
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
            'title'=>'required',
            'link' => 'required',
            'description' => 'required',
            'image' => 'required',
        ], []);
        try {

            if ($request->image) {
                $image_path = 'public/images/ads/';
                $image_url = ImageHelper::saveBase64Image($request->image,$image_path,728,900);
            } else {
                $image_url = 'public/image/no_image.jpg';
            }

            DB::table('ads')->insert([
                'title'=>$request->title,
                'description' => $request->description,
                'link'=>$request->link,
                'image' => $image_url,
                'status' => 0,
                'created_by' => Auth::id(),
                'created_at' => Carbon::now(),
            ]);

            return redirect()->route('ads.index')
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

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $ads = DB::table('ads')
                ->where('id', $id)
                ->first();

            return view('back-end.ads.edit', compact('ads'));
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
            'title'=>'required',
            'link' => 'required',
            'description' => 'required',
        ], []);
        try {

            if ($request->image) {
                $position = strpos($request->image, ';');
                $sub = substr($request->image, 0, $position);
                $ext = explode('/', $sub)[1];
                $image = time() . '.' . $ext;
                $img = Image::make($request->image);
                $upload_path = 'public/images/ads/';
                $image_url = $upload_path . $image;
                $img->resize(728, 90);
                $img->save($image_url);
            } else {
                $image_url = $request->old_image;
            }
            DB::table('ads')
            ->where('id', $id)
            ->update([
                'title'=>$request->title,
                'description' => $request->description,
                'link'=>$request->link,
                'image' => $image_url,
                'status' => 0,
                'created_by' => Auth::id(),
                'created_at' => Carbon::now(),
        ]);
            return redirect()->route('ads.index')
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
            DB::table('ads')
                ->where('id', $id)
                ->delete();

            return redirect()->route('ads.index')
                ->with('error', 'Deleted Successfully');

        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }

    public function ads_status_change(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required',
        ], []);

        try {
            if ($request->status == 1) {
                $slides = DB::table('ads')
                    ->where('status', 1)
                    ->count();

                if ($slides >= 3) {
                    return 0;
                }
            }

            DB::table('ads')
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
