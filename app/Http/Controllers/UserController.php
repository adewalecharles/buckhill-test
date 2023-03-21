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
     */
    public function index()
    {
        try {
            return $this->success('All users fetched', $this->userService->getAllUsers());
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
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
     */
    public function update(UpdateRequest $request, User $user)
    {
        try {
            DB::beginTransaction();
            $response = $this->userService->updateUser($request->validated(), $user);
            return $this->success('User updated', $response);
            DB::commit();
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
            DB::rollBack();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        try {

            return $this->userService->deleteUser($uuid) ? $this->success('User Deleted', []) :
                 $this->error('Could not delete User');
        } catch (\Exception $e) {
            return $this->error('An error occurred');
        }
    }
}
