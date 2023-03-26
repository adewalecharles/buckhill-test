<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Interfaces\AuthServiceInterface;
use DB;

class AuthController extends Controller
{
    /**
     * Auth controller construct
     */
    public function __construct(private AuthServiceInterface $authService)
    {
    }

    /**
     * Method to register users
     *
     *
     * @OA\Post(
     * path="/admin/create",
     * summary="Create admin account",
     * description="Create an account",
     * operationId="authCreate",
     * tags={"admin"},
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="Input User Details",
     *
     *    @OA\JsonContent(
     *       required={"first_name","last_name","email","password","password_confirmation", "address", "phone_number"},
     *
     *       @OA\Property(property="first_name", type="string", example="adewale"),
     *       @OA\Property(property="last_name", type="string", example="charles"),
     *       @OA\Property(property="address", type="string", example="no 3, york lane"),
     *       @OA\Property(property="phone_number", type="string", example="2348253796851"),
     *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *       @OA\Property(property="password_confirmation", type="string", format="password", example="PassWord12345"),
     *    ),
     * ),
     *
     *   @OA\Response(
     *    response=200,
     *    description="Success"
     *     ),
     * )
     */
    public function create(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            DB::beginTransaction();
            $response = $this->authService->registerUser($request->validated());
            DB::commit();

            return $this->success('User created successfully', $response, 200);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), [], $e->getCode());
        }
    }

    /**
     * Method to log in users
     *
     *
     * @OA\Post(
     * path="/admin/login",
     * summary="login admin account",
     * description="login an account",
     * operationId="authLogin",
     * tags={"admin"},
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="Input User Details",
     *
     *    @OA\JsonContent(
     *       required={"email","password"},
     *
     *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *    ),
     * ),
     *
     *   @OA\Response(
     *    response=200,
     *    description="Success"
     *     ),
     * )
     */
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->success('User logged in successfully', $this->authService->loginUser($request->validated()));
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), [], $e->getCode());
        }
    }

    /**
     * Method to logout users
     *
     *
     * @OA\Get(
     * path="/admin/logout",
     * summary="Logout",
     * description="Logout user and invalidate token",
     * operationId="authLogout",
     * tags={"admin"},
     * security={ {"bearerAuth": {} }},
     *
     * @OA\Response(
     *    response=200,
     *    description="Success"
     *     ),
     * @OA\Response(
     *    response=401,
     *    description="Returns when user is not authenticated",
     *
     *    @OA\JsonContent(
     *
     *       @OA\Property(property="message", type="string", example="Not authorized"),
     *    )
     * )
     * )
     */
    public function logout(): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->success('Logout successful');
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), [], $e->getCode());
        }
    }
}
