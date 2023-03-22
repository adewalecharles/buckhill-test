<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Traits\HasJwtToken;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
    use HasJwtToken;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check if token is passed or not
        if (! ($token = $request->bearerToken())) {
            return response()->json([
                'status' => false,
                'message' => 'Bearer token is required',
            ], 401);
        }

        // check if user is found
        if (! ($user = $this->decodeToken($token))) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthenticated',
            ], 401);
        }

        // validate if token is valid then continue log user in and continue request
        if ($this->validateToken($token, $user)) {
            Auth::loginUsingId($user->id);

            return $next($request);
        }

        // throw an error if token is not valid
        return response()->json([
            'status' => false,
            'message' => 'Unauthenticated',
        ], 401);
    }

    private function decodeToken(string $token): ?User
    {
        // decode the token
        $decodedToken = $this->parseToken($token);

        //get the user from the token uuid claim
        return User::where('uuid', $decodedToken->claims()->get('user_uuid'))->first();
    }
}
