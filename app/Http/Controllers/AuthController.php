<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use DB;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    protected $authService;

    /**
     * Auth controller construct
     *
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Method to register users
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            DB::beginTransaction();
            $response = $this->authService->registerUser($request->validated());
            DB::commit();
            return $this->success('User created successfully',$response,200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage());
        }

    }

    /**
     * Method to log in users
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request):\Illuminate\Http\JsonResponse
    {
        try {
            return $this->success('User logged in successfully', $this->authService->loginUser($request->validated()));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

    }

    /**
     * Method to logout users
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): \Illuminate\Http\JsonResponse
    {
        try {
            if ($this->authService->logoutUser()) {
             return $this->success('Logout successful');
            }
            return $this->error('Logout Failed');
        } catch (\Throwable $e) {
            return $this->error($e->getMessage());
        }
    }
}
