<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $users = User::where('name', $request->input('username'))->get();
        foreach ($users as $user){
            $check = Hash::check( $request->input('password'), $user->password);
            if($check){
                $found = $user;
                break;
            }
        }
        if(!isset($found)){
            return \response()->json(['message' => 'Wrong user!'], 500);
        }

        return $next($request);
    }
}
