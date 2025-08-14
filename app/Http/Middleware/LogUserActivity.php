<?php
namespace App\Http\Middleware;

use App\Models\Log\UserLog;
use Closure;
use Illuminate\Support\Facades\Auth;

class LogUserActivity
{
    public function handle($request, Closure $next, $actionName)
    {
        $response = $next($request);    

        $status = true;
        if ($response->getStatusCode() >= 400) {
            $status = false;
        }   

        $user = auth()->user(); 

        UserLog::create([
            'user_id'    => $user->id ?? null,
            'name'       => $user->name ?? null,
            'email'      => $user->email ?? null,
            'action'     => [
                'name' => $actionName,
                'status' => $status,
                'message' => '',
            ],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'url'        => $request->fullUrl(),
        ]); 

        return $response;
    }
}
