<?php

namespace App\Http\Controllers;

use App\Helper\ImageHelper;
use App\Models\Slider;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;


class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = DB::table('sliders')
                    ->orderBy('id', 'DESC')
                    ->get();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('title', function ($data) {
                        return $data->title;

                    })
                    ->addColumn('image', function ($data) {
                        return '<a target="_blank" href="' . asset($data->image) . '">
                                   <img class="image" style="width:60px; height: 40px" src="' . asset($data->image) . '"/>
                                </a>';
                    })
                    ->addColumn('news', function ($data) {
                        return $data->news_id;
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
                                        href="' . route('slides.edit', $data->id) . '" class="btn btn-sm btn-success" style="cursor:pointer"
                                        title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                     <a class="btn btn-sm btn-danger" style="cursor:pointer"
                                       href="' . route('slides.destroy', [$data->id]) . '"
                                       onclick="showDeleteConfirm(' . $data->id . ')" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>';
                    })
                    ->rawColumns(['image', 'title', 'news', 'status', 'action'])
                    ->make(true);
            }
            return view('back-end.slide.banner.index');
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
            return view('back-end.slide.banner.create');
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
            'title' => 'required',
            'image' => 'required',
        ], []);
        try {

            if ($request->image) {
                $image_path = 'public/images/slides/';
                $image_url = ImageHelper::saveBase64Image($request->image,$image_path,800,500);
            } else {
                $image_url = 'public/image/no_image.jpg';
            }

            DB::table('sliders')->insert([
                'title' => $request->title,
                'news_id' => $request->news_id ?? 1,
                'image' => $image_url,
                'status' => 0,
                'created_by' => Auth::id(),
                'created_at' => Carbon::now(),
            ]);

            return redirect()->route('slides.index')
                ->with('success', 'Added Successfully');
        } catch (\Exception $exception) {

            return redirect()->back()->with('error', $exception->getMessage());
        }


    }


    public function destroy($id)
    {
        try {
            DB::table('sliders')
                ->where('id', $id)
                ->delete();

            return redirect()->route('slides.index')
                ->with('error', 'Deleted Successfully');

        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }


    public function slide_status_change(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required',
        ], []);

        try {

            DB::table('sliders')
                ->where('id', $request->id)
                ->update([
                    'status' => $request->status
                ]);

            return 1;

        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }

    public function featured_slides_index(Request $request){

        $categories = DB::table('news_categories')
            ->orderBy('id', 'DESC')
            ->get();

        $news_types = DB::table('news_types')
            ->orderBy('id', 'DESC')
            ->get();

        try {
            if ($request->ajax()) {
                $query = DB::table('news as n')
                    ->leftjoin('news_categories as c', 'n.category_id', '=', 'c.id')
                    ->leftjoin('news_types as t', 'n.type', '=', 't.id')
                    ->orderBy('n.id', 'DESC');


                if ($request->date) {
                    $query->where('date', $request->date);
                }
                if ($request->category_id) {
                    $query->where('category_id', $request->category_id);
                }
                if ($request->type) {
                    $query->where('type', $request->type);
                }
                if ($request->title) {
                    $query->where('title', 'like', '%' . $request->title . '%');
                }

                $data = $query
                    ->select(['n.*','c.name as category_name','t.name as type_name']);

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function ($data) {
                        return '<a target="_blank" href="' . asset($data->image) . '">
                                   <img class="image" style="width:60px; height: 40px" src="' . asset($data->image) . '"/>
                                </a>';
                    })
                    ->addColumn('date', function ($data) {
                        return Carbon::parse($data->date)->format('d-M-Y');
                    })
                    ->addColumn('title', function ($data) {
                        return $data->title;
                    })
                    ->addColumn('category_id', function ($data) {
                        return $data->category_name;
                    })
                    ->addColumn('type', function ($data) {
                        return $data->type_name;
                    })
                    ->addColumn('action', function ($data) {
                        return '<div class="" role="group">
                                   
                                </div>';
                    })
                    ->rawColumns(['image', 'date', 'title', 'category_id', 'type', 'action'])
                    ->make(true);
            }
            return view('back-end.slide.featured.index',compact('news_types','categories'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
