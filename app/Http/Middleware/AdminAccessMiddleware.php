<?php

namespace App\Http\Middleware;

use App\User\exception\UserException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @throws UserException
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()){
            throw UserException::UserNotFoundException();
        }

        $user = Auth::user();
        if ($user->user_type != 0){
            throw UserException::UserPermissionsException();
        }
        return $next($request);
    }
}
