<?php

namespace App\Http\Controllers;

use App\Helper\ImageHelper;
use App\Models\gallery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;
use DataTables;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = DB::table('galleries')
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
                                    <button onclick="addImage(' . $data->id . ')" id=""
                                        class="btn btn-sm btn-primary" style="cursor:pointer"
                                        title="add image">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                    <a id=""
                                        href="' . route('gallery.show', $data->id) . '" class="btn btn-sm btn-success" style="cursor:pointer"
                                        title="View">
                                        <i class="fa fa-info-circle"></i>
                                    </a>
                                    <a id=""
                                        href="' . route('gallery.edit', $data->id) . '" class="btn btn-sm btn-warning" style="cursor:pointer"
                                        title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a class="btn btn-sm btn-danger" style="cursor:pointer"
                                       href="' . route('gallery.destroy', [$data->id]) . '"
                                       onclick="showDeleteConfirm(' . $data->id . ')" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>';
                    })
                    ->rawColumns(['image', 'title', 'status', 'action'])
                    ->make(true);
            }
            return view('back-end.gallery.index');
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
            return view('back-end.gallery.create');
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
        ], []);
        try {

            if ($request->image) {
                $image_path = 'public/images/gallery/';
                $image_url = ImageHelper::saveBase64Image($request->image, $image_path, 800, 500);
            } else {
                $image_url = 'public/image/no_image.jpg';
            }

            DB::table('galleries')->insert([
                'description' => $request->description,
                'image' => $image_url,
                'title' => $request->title,
                'status' => 1,
                'created_by' => Auth::id(),
                'created_at' => Carbon::now(),
            ]);

            return redirect()->route('gallery.index')
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
            $gallery = DB::table('galleries')
                ->where('id', $id)
                ->first();

            $gallery_images = DB::table('gallery_images')
                ->where('gallery_id', $id)
                ->get();

            return view('back-end.gallery.show', compact('gallery','gallery_images'));
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
            $gallery = DB::table('galleries')
                ->where('id', $id)
                ->first();

            return view('back-end.gallery.edit', compact('gallery'));
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
            'title' => 'required',
        ], []);
        try {

            if ($request->image) {
                $position = strpos($request->image, ';');
                $sub = substr($request->image, 0, $position);
                $ext = explode('/', $sub)[1];
                $image = time() . '.' . $ext;
                $img = Image::make($request->image);
                $upload_path = 'public/images/gallery/';
                $image_url = $upload_path . $image;
                $img->resize(700, 435);
                $img->save($image_url);
            } else {
                $image_url = $request->old_image;
            }

            DB::table('galleries')
                ->where('id', $id)
                ->update([
                    'description' => $request->description,
                    'image' => $image_url,
                    'title' => $request->title,
                    'status' => 0,
                    'created_by' => Auth::id(),
                    'created_at' => Carbon::now(),
                ]);

            return redirect()->route('gallery.index')
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
            DB::table('galleries')
                ->where('id', $id)
                ->delete();

            return redirect()->route('gallery.index')
                ->with('error', 'Deleted Successfully');

        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }

    public function gallery_status_change(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required',
        ], []);

        try {
            if ($request->status == 1) {
                $slides = DB::table('galleries')
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


        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }

    }

    public function add_new_image_gallery(Request $request)
    {

        try {
            $count = count($request->image);

            if ($count) {
                $image_path = 'public/images/gallery/';
                for ($i = 0; $i < $count; $i++) {
                    $image_url = ImageHelper::saveBase64Image($request->image[$i], $image_path, 800, 500);

                    DB::table('gallery_images')->insert([
                        'gallery_id' => $request->gallery_id,
                        'image' => $image_url,
                        'created_at' => Carbon::now(),
                    ]);
                }

            }

            return redirect()->route('gallery.index')
                ->with('success', 'Image Added Successfully');

        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function gallery()
    {
      
        return view('front-end.pages.gallery.index');
    }

    public function gallery_details($id)
    {

      try {
            $gallery = DB::table('galleries')
                ->where('id', $id)
                ->first();

            $gallery_images = DB::table('gallery_images')
                ->where('gallery_id', $id)
                ->get();

            return view('front-end.pages.gallery.gallery-details', compact('gallery','gallery_images'));
        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }

}
