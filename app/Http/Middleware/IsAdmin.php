<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Traits\HasJwtToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    use HasJwtToken;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //get the bearer token
        $token = $request->bearerToken();

        // parse the token
        $parsedToken = $this->parseToken($token);

        // get the user
        $user = User::where('uuid', $parsedToken->claims()->get('user_uuid'))->first();

        if (! $user) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Bearer Token',
            ], 400);
        }

        //check if user is admin
        if ($user->is_admin) {
            return $next($request);
        }

        // return error if user is not admin
        return response()->json([
            'status' => false,
            'message' => 'You are not permitted to access to use this resource',
        ], 403);
    }
}
