<?php

namespace App\Http\Middleware;

use App\User\exception\UserException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPetAdoptionStatus
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @throws UserException
     */
    public function handle(Request $request, Closure $next): Response
    {
        $pet = request()->route('pet');
        if ($pet->status != 'adopted'){
            return $next($request);
        }
        throw UserException::petDoesNotAdoption();
    }
}
