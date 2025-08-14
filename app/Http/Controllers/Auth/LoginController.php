<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;
use Carbon\Carbon;

use App\Models\Log\UserLog;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function authenticated($request, $user)
    {
        // Simpan log ke MongoDB
        UserLog::create([
            'user_id'    => $user->id,
            'name'       => $user->name,
            'email'      => $user->email,
            'action'     => [
                'name' => 'login',
                'status' => true,
                'message' => '',
            ],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'logged_in_at' => now(),
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        // Simpan log ke MongoDB
        UserLog::create([
            'user_id'    => $user->id,
            'name'       => $user->name,
            'email'      => $user->email,
            'action'     => [
                'name' => 'logout',
                'status' => true,
                'message' => '',
            ],
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'logged_in_at' => Carbon::now(), // bisa juga logged_out_at
        ]);

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
