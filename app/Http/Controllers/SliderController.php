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
//        try {
        if ($request->ajax()) {
            $data = DB::table('sliders')
                ->where('sliders.type', 1)
                ->leftjoin('news', 'sliders.news_id', '=', 'news.id')
                ->leftjoin('news_categories', 'news.category_id', '=', 'news_categories.id')
                ->leftjoin('news_types', 'news.type', '=', 'news_types.id')
                ->orderBy('id', 'DESC')
                ->get(['sliders.*', 'news.title', 'news.date', 'news.image as news_image','news_categories.name as news_cat_name', 'news_types.name as news_type_name']);


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
                    return "<table class='table table-bordered'>
                                <tbody>
                                   <tr>
                                        <th style='width: 15%'>Date</th>

                                        <td style='width: 85%'>$data->date</td>
                                    </tr>
                                    <tr>
                                        <th>Title</th>

                                        <td>$data->title</td>
                                    </tr>
                                    <tr>
                                        <th>Cat</th>

                                        <td>$data->news_cat_name</td>
                                    </tr>
                                    <tr>
                                        <th>Type</th>

                                        <td>$data->news_type_name</td>

                                    <tr>
                                        <th>Image</th>

                                        <td>
                                            <a target='_blank' href=".asset($data->news_image).">
                                               <img class='image' style='width:60px; height: 40px' src=".asset($data->news_image)."/>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>";
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == 1) {
                        return "<select style='width: 100%' id='status-$data->id' onchange='statusChange([$data->id])' class='form-control'>
                                            <option selected  value='1' >Active</option>
                                            <option  value='0'>In active</option>
                                        </select>";
                    } else {
                        return "<select style='width: 100%' id='status-$data->id' onchange='statusChange([$data->id])' class='form-control'>
                                            <option  value='1' >Active</option>
                                            <option selected  value='0'>In active</option>
                                        </select>";
                    }


                })
                ->addColumn('action', function ($data) {
                    return '<div class="" role="group">
                                    <button id="" onclick="addNews(' . $data->id . ')"
                                       class="btn btn-sm btn-primary" style="cursor:pointer"
                                        title="Add news">
                                        <i class="fa fa-plus"></i>
                                    </button>
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
//        } catch (\Exception $exception) {
//            return redirect()->back()->with('error', $exception->getMessage());
//        }
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
                $image_url = ImageHelper::saveBase64Image($request->image, $image_path, 800, 500);
            } else {
                $image_url = 'public/image/no_image.jpg';
            }

            DB::table('sliders')->insert([
                'title' => $request->title,
                'news_id' => $request->news_id ?? null,
                'image' => $image_url,
                'type' => 1,
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

    public function add_news_to_slides_modal(Request $request)
    {
        $type = $request->type;
        $slide_id = $request->id;
        $categories = DB::table('news_categories')
            ->orderBy('id', 'DESC')
            ->get();

        $news_types = DB::table('news_types')
            ->orderBy('id', 'DESC')
            ->get();

        $html = view('back-end.slide.add-news',
            compact('categories', 'news_types', 'slide_id', 'type'))
            ->render();

        return response()->json([$html]);

    }

    public function add_news_to_slide(Request $request)
    {
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
                    ->select(['n.*', 'c.name as category_name', 't.name as type_name']);

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
                    ->addColumn('action', function ($data) use ($request) {
                        if ($request->slide_id) {
                            return '<div class="" role="group">
                                   <a onclick="return confirm(`Are You Sure ? Previous news will be repleace`)" title="add to featured slide" href="' . route('news-add-to-slide', [$data->id, $request->slide_id]) . '" class="btn btn-sm btn-primary">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>';
                        } else {
                            return '<div class="" role="group">
                                   <a onclick="return confirm(`Are You Sure ?`)" title="add to featured slide" href="' . route('news-add-to-featured-slide', $data->id) . '" class="btn btn-sm btn-primary">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>';
                        }

                    })
                    ->rawColumns(['image', 'date', 'title', 'category_id', 'type', 'action'])
                    ->make(true);
            }

        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $sliders = DB::table('sliders')
                ->where('id', $id)
                ->first();

            return view('back-end.slide.banner.edit', compact('sliders'));
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
            'title' => 'required',
            'image' => 'required',
        ], []);

        try {
            if ($request->image) {
                $position = strpos($request->image, ';');
                $sub = substr($request->image, 0, $position);
                $ext = explode('/', $sub)[1];
                $image = time() . '.' . $ext;
                $img = Image::make($request->image);
                $upload_path = 'public/images/slides/';
                $image_url = $upload_path . $image;
                $img->resize(700, 435);
                $img->save($image_url);
            } else {
                $image_url = $request->old_image;
            }

            DB::table('sliders')
                ->where('id', $id)
                ->update([
                    'title' => $request->title,
                    'news_id' => $request->news_id ?? null,
                    'image' => $image_url,
                    'type' => 1,
                    'status' => 0,
                    'created_by' => Auth::id(),
                    'updated_at' => Carbon::now(),
                ]);

            return redirect()->route('slides.index')
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

    public function featured_slides_index(Request $request)
    {

        try {

            if ($request->ajax()) {

                $slide = DB::table('sliders')
                    ->where('type', 2)
                    ->pluck('news_id');

                $data = DB::table('news as n')
                    ->whereIn('n.id', $slide)
                    ->leftjoin('news_categories as c', 'n.category_id', '=', 'c.id')
                    ->leftjoin('news_types as t', 'n.type', '=', 't.id')
                    ->orderBy('n.id', 'DESC')
                    ->select(['n.*', 'c.name as category_name', 't.name as type_name'])
                    ->get();

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
                                   <a onclick="return confirm(`Are You Sure ? You can not revert it`)" title="add to featured slide" href="' . route('news-remove-from-featured-slide', $data->id) . '" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>';
                    })
                    ->rawColumns(['image', 'date', 'title', 'category_id', 'type', 'action'])
                    ->make(true);
            }
            return view('back-end.slide.featured.index');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }

    }

    public function news_add_to_slide($news_id, $slide_id)
    {
        try {
            DB::table('sliders')
                ->where('id', $slide_id)
                ->update([
                    'news_id' => $news_id
                ]);

            return view('back-end.slide.banner.index')
                ->with('success', 'News added Successfully');;
        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }

    public function news_add_to_featured_slide($news_id)
    {

        try {
            $check = DB::table('sliders')
                ->where('type', 2)
                ->where('news_id', $news_id)
                ->exists();

            if ($check) {
                return redirect()->route('featured-slides.index')
                    ->with('error', 'Selected news already added in the list');
            }

            $count = DB::table('sliders')
                ->where('type', 2)
                ->count();

            if ($count >= 4) {
                return redirect()->route('featured-slides.index')
                    ->with('error', 'You can not add news to featured slide more than 4. delete exist one to add another');
            }

            DB::table('sliders')->insert([
                'title' => '-',
                'news_id' => $news_id,
                'type' => 2,
                'image' => '-',
                'status' => 1,
                'created_by' => Auth::id(),
                'created_at' => Carbon::now(),
            ]);

            return redirect()->route('featured-slides.index')
                ->with('success', 'Added Successfully');

        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }


    public function news_remove_from_featured_slide($news_id)
    {
        try {

            DB::table('sliders')
                ->where('type', 2)
                ->where('news_id', $news_id)
                ->delete();

            return redirect()->route('featured-slides.index')
                ->with('error', 'Delete Successfully');

        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }
}
