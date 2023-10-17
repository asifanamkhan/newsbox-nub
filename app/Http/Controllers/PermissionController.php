<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
class PermissionController extends Controller
{
    public function index(Request $request){
        try {
            if ($request->ajax()) {
                $data = DB::table('permissions')
                    ->orderBy('id', 'DESC')
                    ->get();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function ($data) {
                        return $data->name;
                    })
                    ->rawColumns(['name'])
                    ->make(true);
            }
            return view('back-end.administrator.permission.index');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
