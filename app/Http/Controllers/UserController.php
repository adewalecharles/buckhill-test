<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Services\UserService;
use DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index():\Illuminate\Http\JsonResponse
    {
        try {
            return $this->success('All users fetched', $this->userService->getAllUsers());
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, User $user): \Illuminate\Http\JsonResponse
    {
        try {
            DB::beginTransaction();
            $response = $this->userService->updateUser($request->validated(), $user);
            DB::commit();
            return $this->success('User updated', $response);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
            DB::rollBack();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $uuid): \Illuminate\Http\JsonResponse
    {
        try {

            return $this->userService->deleteUser($uuid) ? $this->success('User Deleted', []) :
                 $this->error('Could not delete User');
        } catch (\Exception $e) {
            return $this->error('An error occurred');
        }
    }
}
