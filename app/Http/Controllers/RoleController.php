<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Hash;

class RoleController extends Controller
{
    public function index(Request $request){

        try {
            if ($request->ajax()) {
                $data = DB::table('roles')
                    ->orderBy('id', 'DESC')
                    ->get();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function ($data) {
                        return $data->name;
                    })
                    ->addColumn('permissions', function ($data) {
                        $permissions = DB::table('role_has_permissions as r')
                            ->where('r.role_id',$data->id)
                            ->leftjoin('permissions as p', 'r.permission_id', '=', 'p.id')
                            ->get(['r.*','p.name']);

                        $result = '';
                        foreach ($permissions as $permission){
                            $result .= "<span class='badge' style='margin-right: 3px; background: forestgreen'>$permission->name</span>";
                        }

                        return $result;

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
                    ->rawColumns(['name','permissions','action'])
                    ->make(true);
            }
            return view('back-end.administrator.role.index');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function create(){
        try {
            $permissions = DB::table('permissions')->get();
            return view('back-end.administrator.role.create', compact('permissions'));
        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'permissions' => 'required',

        ], []);

        try {

            $role = new Role();
            $role->name = $request->name;
            $role->guard_name = 'web';
            $role->save();


            $role->syncPermissions(['admin']);

            return redirect()->route('roles.index')
                ->with('success', 'Successfully Submited');
        } catch (\Exception $exception) {

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
