<?php

namespace App\Http\Controllers\userSystem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Log\UserLog;

class UserSystemController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function indexUser()
    {  
        $data['title'] = 'User Index';
        $data['roles'] = Role::get();
        return view('userSystem.user', $data);
    }

    public function dataUser(Request $request)
    {
        $data = User::get();

        return DataTables::of($data)
        ->addColumn('roles', function($data){
            return $data->roles->implode('name', ', ');
        })
        ->addColumn('edit', function($data){
            return '<button class="btn btn-warning" data-id="'.$data->id.'" onClick="editUser(this)"><i class="fas fa-pencil"></i></button>';
        })
        ->addColumn('activity', function($data){
            return '<button class="btn btn-info" data-id="'.$data->id.'"><i class="fas fa-eye"></i></button>';
        })
        ->rawColumns(['edit', 'activity'])
        ->make(true);
    }

    public function postUser(Request $request)
    {
        try {
            // var_dump($request->all());
            // die();
            DB::transaction(function() use($request){
                $data = [
                    'name'  => $request->name,
                    'email' => $request->email,
                ];
                if ($request->isChecked) {
                    $data['password'] = Hash::make($request->password);
                }

                $user = User::updateOrCreate(
                    ['id' => $request->id],
                    $data
                );
                $role = Role::find($request->role);
                $user->syncRoles([$role->id]);
                UserLog::create([
                    'user_id'    => Auth::user()->id,
                    'name'       => Auth::user()->name,
                    'email'      => Auth::user()->email,
                    'action'     => [
                        'name' => 'post user',
                        'data' => [
                            'type' => 'user',
                            'id' => $user->id,
                            'name' => $request->name,
                        ],
                        'status' => true,
                        'message' => 'Aksi Berhasil',
                    ],
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'url'        => $request->fullUrl(),
                ]); 
            });

            return response()->json([
                'success' => true,
                'message' => 'Aksi Berhasil',
            ]);
        } catch (\Throwable $th) {
            UserLog::create([
                'user_id'    => Auth::user()->id,
                'name'       => Auth::user()->name,
                'email'      => Auth::user()->email,
                'action'     => [
                    'name' => 'post user',
                    'data' => [
                        'type' => 'user',
                        'id' => '-',
                        'name' => $request->name . ', ' . $request->email,
                    ],
                    'status' => false,
                    'message' => $th->getMessage(),
                ],
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url'        => $request->fullUrl(),
            ]); 

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function indexRole()
    {
        $data['title'] = 'Role Index';
        return view('userSystem.role', $data);
    }

    public function dataRole(Request $request)
    {
        $data = Role::get();

        return DataTables::of($data)
        ->addColumn('edit', function($data){
            return '<button class="btn btn-warning" data-id="'.$data->id.'" onClick="editRole(this)"><i class="fas fa-pencil"></i></button>';
        })
        ->addColumn('activity', function($data){
            return '<button class="btn btn-info" data-id="'.$data->id.'">Assigned Permission</button>';
        })
        ->rawColumns(['edit', 'activity'])
        ->make(true);
    }
}
