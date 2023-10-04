<?php

namespace App\Http\Controllers\news;

use App\Helper\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use Image;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {

            $categories = DB::table('news_categories')
                ->orderBy('id', 'DESC')
                ->get();

            $news_types = DB::table('news_types')
                ->orderBy('id', 'DESC')
                ->get();

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
                                        href="' . route('news.show', $data->id) . '" class="btn btn-sm btn-primary" style="cursor:pointer"
                                        title="View">
                                        <i class="fa fa-info-circle"></i>
                                    </a>
                                    <a id=""
                                        href="' . route('news.edit', $data->id) . '" class="btn btn-sm btn-success" style="cursor:pointer"
                                        title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a class="btn btn-sm btn-danger" style="cursor:pointer"
                                       href="' . route('news.destroy', [$data->id]) . '"
                                       onclick="showDeleteConfirm(' . $data->id . ')" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>';
                    })
                    ->rawColumns(['image', 'date', 'title', 'category_id', 'type','status', 'action'])
                    ->make(true);
            }
            return view('back-end.news.news.index',compact('categories','news_types'));
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
            $categories = DB::table('news_categories')
                ->orderBy('id', 'DESC')
                ->get();

            $news_types = DB::table('news_types')
                ->orderBy('id', 'DESC')
                ->get();

            return view('back-end.news.news.create',compact('categories','news_types'));
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
            'date' => 'required',
            'type' => 'required',
            'category_id' => 'required',
            'description' => 'required',
        ], []);
        try {

            if ($request->image) {
                $image_path = 'public/images/news/';
                $image_url = ImageHelper::saveBase64Image($request->image,$image_path,800,500);
            } else {
                $image_url = 'public/image/no_image.jpg';
            }

            DB::table('news')->insert([
                'title' => $request->title,
                'date' => $request->date,
                'type' => $request->type,
                'category_id' => $request->category_id,
                'image' => $image_url,
                'description' => $request->description,
                'status' => 1,
                'created_by' => Auth::id(),
                'created_at' => Carbon::now(),
            ]);

            return redirect()->route('news.index')
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
            $news = DB::table('news as n')
                ->where('n.id', $id)
                ->leftjoin('news_categories as c', 'n.category_id', '=', 'c.id')
                ->leftjoin('news_types as t', 'n.type', '=', 't.id')
                ->leftjoin('users as u', 'n.created_by', '=', 'u.id')
                ->orderBy('n.id', 'DESC')
                ->first(['n.*','c.name as category_name','t.name as type_name','u.name as created_user_name']);

            return view('back-end.news.news.show', compact('news'));
        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $news = DB::table('news')
            ->where('id', $id)
            ->first();
        $categories = DB::table('news_categories')
            ->orderBy('id', 'DESC')
            ->get();

        $news_types = DB::table('news_types')
            ->orderBy('id', 'DESC')
            ->get();
        try {
            return view('back-end.news.news.edit', compact('news','categories','news_types'));
        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'title' => 'required',
            'date' => 'required',
            'type' => 'required',
            'category_id' => 'required',
            'description' => 'required',
        ], []);
        try {

            if ($request->image) {
                $position = strpos($request->image, ';');
                $sub = substr($request->image, 0, $position);
                $ext = explode('/', $sub)[1];
                $image = time() . '.' . $ext;
                $img = Image::make($request->image);
                $upload_path = 'public/images/news/';
                $image_url = $upload_path . $image;
                $img->resize(700, 435);
                $img->save($image_url);
            } else {
                $image_url = $request->old_image;
            }

            DB::table('news')
                ->where('id', $id)
                ->update([
                    'title' => $request->title,
                    'date' => $request->date,
                    'type' => $request->type,
                    'category_id' => $request->category_id,
                    'image' => $image_url,
                    'description' => $request->description,
                    'status' => 1,
                    'created_by' => Auth::id(),
                    'created_at' => Carbon::now(),
                ]);

            return redirect()->route('news.index')
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
            DB::table('news')
                ->where('id', $id)
                ->delete();

            return redirect()->route('news.index')
                ->with('error', 'Deleted Successfully');

        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }

    public function news_status_change(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required',
        ], []);

        try {

            DB::table('news')
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
