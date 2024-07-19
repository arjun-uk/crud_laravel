<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomTokenAuth
{
 
    public function handle(Request $request, Closure $next)
    {
        try {

            $request->headers->set('authorization',  $request->header('token'));
            // dd($request);
            //     $header = $request->header('authorization');
            //     return $this->errorResponse($request,'YAFDFASD service',0,401);
            if(Auth::guard('api')->check()) {

                return $next($request);
            } else {
 
                return response()->json([
                   'message' => 'You are not authenticated to this service',
                ], 401);
                
            }
        } catch (RequestException $exception) {
        }

        return response('You are not authenticated to this service');
    }
    
   
}
