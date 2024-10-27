<?php

namespace App\Http\Middleware;

use App\Models\PetEntry;
use App\User\exception\UserException;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PreventDuplicateAdoption
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @throws Exception
     */
    public function handle(Request $request, Closure $next)
    {
        $petId = $request->route('id');
        $exists = Auth::user()->userAdoption()->where('animal_id', $petId)->exists();

        if ($exists){
            throw UserException::adoptionDuplicate();
        }
        return $next($request);
    }
}
