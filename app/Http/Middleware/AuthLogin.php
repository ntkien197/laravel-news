<?php

namespace App\Http\Middleware;

use App\Helpers\GlobalHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
//use Tymon\JWTAuth\Exceptions\TokenExpiredException;
//use Tymon\JWTAuth\Exceptions\TokenInvalidException;
//use Tymon\JWTAuth\Exceptions\JWTException;

class AuthLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
//        $header = $request->header('Authorization');
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if(!$user) {
                return response()->json([
                    'status'  => false,
                    'message' => GlobalHelper::getMessageErrorCode(404),
                    'code'    => 404,
                    'data'    => [],
                ], 200);
            }
            return $next($request);
        }
        catch(\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
//            dd($e);
            return response()->json([
                'status'  => false,
                'message' => 'Token Expired',
                'code'    => 401,
                'data'    => [],
            ], 200);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Token Invalid',
                'code'    => 401,
                'data'    => [],
            ], 200);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Token Absent',
                'code'    => 401,
                'data'    => [],
            ], 200);
        }
    }
}
