<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class GetMasterDataController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function userData(Request $request){
        $user = User::with('roles')->find($request->id);
        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Data ditemukan',
                'data' => $user
            ]);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ]);
        }
    }

    public function roleData(Request $request)
    {
        $data = Role::find($request->id);
        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Data ditemukan',
                'data' => $data
            ]);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ]);
        }
    }
}
