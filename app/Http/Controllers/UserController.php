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
     *
     * @OA\Get(
     * path="/admin/user-listing",
     * summary="Get users",
     * description="Get all non admin users",
     * operationId="usersListing",
     * tags={"admin"},
     * security={ {"bearer": {} }},
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status", type="boolean", example="true"),
     *       @OA\Property(property="message", type="string", example="All users fetched"),
     *       @OA\Property(property="data", type="object"),
     *    )
     *   ),
     * )
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
     *
     * @OA\Put(
     * path="/admin/user-edit/{uuid}",
     * summary="Update user record",
     * description="Update user record",
     * operationId="userUpdate",
     * tags={"admin"},
     * security={ {"bearer": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="Input User Details",
     *    @OA\JsonContent(
     *       required={"first_name","last_name","email", "address", "phone_number"},
     *       @OA\Property(property="first_name", type="string", example="adewale"),
     *       @OA\Property(property="last_name", type="string", example="charles"),
     *       @OA\Property(property="address", type="string", example="no 3, york lane"),
     *       @OA\Property(property="phone_number", type="string", example="2348253796851"),
     *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *      @OA\Property(property="is_marketing", type="boolean", example="true"),
     *    ),
     * ),
     *   @OA\Response(
     *    response=200,
     *    description="Success"
     *     ),
     * )
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
     *
     * @OA\Delete(
     * path="/admin/user-delete/{uuid}",
     * summary="Delete user",
     * description="Delete user record ",
     * operationId="userDelete",
     * tags={"admin"},
     * security={ {"bearer": {} }},
     * @OA\Response(
     *    response=200,
     *    description="User Deleted"
     *     ),
     * )
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
