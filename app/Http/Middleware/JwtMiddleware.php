<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try{
            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json([
                    'success' => false,
                    'message' => "無此使用者",
                    'data' => $user
                ]);
            }
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
               'message' => '驗證錯誤',
            ]);
        }
        return $next($request);
    }
}
