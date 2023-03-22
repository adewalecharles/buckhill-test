<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Services\UserService;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
     *
     * @OA\Get(
     * path="/admin/user-listing",
     * summary="Get users",
     * description="Get all non admin users",
     * operationId="usersListing",
     * tags={"admin"},
     * security={ {"bearerAuthAuth": {} }},
     *
     *  @OA\Parameter(name="limit", in="query", description="limit", required=false,
     *
     *        @OA\Schema(type="integer")
     *    ),
     *
     *    @OA\Parameter(name="page", in="query", description="the page number", required=false,
     *
     *        @OA\Schema(type="integer")
     *    ),
     *
     *    @OA\Parameter(name="desc", in="query", description="true or false", required=false,
     *
     *        @OA\Schema(type="string")
     *    ),
     *
     *      @OA\Parameter(name="q", in="query", description="search parameter", required=false,
     *
     *        @OA\Schema(type="string")
     *    ),
     *
     *    @OA\Parameter(name="sortBy", in="query", description="column to sort with, e.g id, first_name, last_name, created_at", required=false,
     *
     *        @OA\Schema(type="string")
     *    ),
     *
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *
     *    @OA\JsonContent(
     *
     *       @OA\Property(property="status", type="boolean", example="true"),
     *       @OA\Property(property="message", type="string", example="All users fetched"),
     *       @OA\Property(property="data", type="object"),
     *    )
     *   ),
     * )
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->success('All users fetched', $this->userService->getAllUsers());
        } catch (ModelNotFoundException $e) {
            return $this->error($e->getMessage(), [], $e->getCode());
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), [], $e->getCode());
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
     *
     *
     * @OA\Put(
     * path="/admin/user-edit/{uuid}",
     * summary="Update user record",
     * description="Update user record",
     * operationId="userUpdate",
     * tags={"admin"},
     * security={ {"bearerAuth": {} }},
     *
     * @OA\Parameter(name="uuid", in="path", description="uuid of user", required=true,
     *
     *        @OA\Schema(type="string")
     *    ),
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="Input User Details",
     *
     *    @OA\JsonContent(
     *       required={"first_name","last_name","email", "address", "phone_number"},
     *
     *       @OA\Property(property="first_name", type="string", example="adewale"),
     *       @OA\Property(property="last_name", type="string", example="charles"),
     *       @OA\Property(property="address", type="string", example="no 3, york lane"),
     *       @OA\Property(property="phone_number", type="string", example="2348253796851"),
     *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *      @OA\Property(property="is_marketing", type="boolean", example="true"),
     *    ),
     * ),
     *
     *   @OA\Response(
     *    response=200,
     *    description="Success"
     *     ),
     * )
     */
    public function update(UpdateRequest $request, $uuid): \Illuminate\Http\JsonResponse
    {
        try {
            DB::beginTransaction();
            $response = $this->userService->updateUser($request->validated(), $uuid);
            DB::commit();

            return $this->success('User updated', $response);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();

            return $this->error($e->getMessage(), [], $e->getCode());
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->error($e->getMessage(), [], $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @OA\Delete(
     * path="/admin/user-delete/{uuid}",
     * summary="Delete user",
     * description="Delete user record ",
     * operationId="userDelete",
     * tags={"admin"},
     * security={ {"bearerAuth": {} }},
     *
     * @OA\Parameter(name="uuid", in="path", description="uuid of product", required=true,
     *
     *        @OA\Schema(type="string")
     *    ),
     *
     * @OA\Response(
     *    response=200,
     *    description="User Deleted"
     *     ),
     * )
     */
    public function destroy(string $uuid): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->success('User Deleted', [], 200);
        } catch (ModelNotFoundException $e) {
            return $this->error($e->getMessage(), [], $e->getCode());
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), [], $e->getCode());
        }
    }
}
