<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request){

        try {
            if ($request->ajax()) {

                $data = \App\Models\User::with('roles')
                    ->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function ($data) {
                        return $data->name;
                    })
                    ->addColumn('email', function ($data) {
                        return $data->email;
                    })
                    ->addColumn('roles', function ($data) {
                        return $data->roles->first()->name;

                    })
                    ->addColumn('action', function ($data) {
                        return '<div class="" role="group">
                                    <a id=""
                                        href="' . route('roles.edit', $data->id) . '" class="btn btn-sm btn-success" style="cursor:pointer"
                                        title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a class="btn btn-sm btn-danger" style="cursor:pointer"
                                       href="' . route('roles.destroy', [$data->id]) . '"
                                       onclick="showDeleteConfirm(' . $data->id . ')" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>';
                    })
                    ->rawColumns(['name','email','roles','action'])
                    ->make(true);
            }
            return view('back-end.administrator.admin.index');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function create(){
        try {
            $roles = DB::table('roles')->get();
            return view('back-end.administrator.admin.create', compact('roles'));
        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }

    public function store(Request $request){
        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'password' => 'required|confirmed|min:6',

        ], []);
        try {

            $user = \App\Models\User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('123456'),
                'created_at' => Carbon::now(),
            ]);

            $user->assignRole($request->role);

            return redirect()->route('users.index')
                ->with('success', 'Successfully Submited');
        } catch (\Exception $exception) {

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
