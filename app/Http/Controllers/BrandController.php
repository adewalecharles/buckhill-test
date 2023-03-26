<?php

namespace App\Http\Controllers;

use App\Interfaces\BrandServiceInterface;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct(private BrandServiceInterface $brandService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     * path="/brands",
     * summary="Get brands",
     * description="Get all brands",
     * operationId="brandsListing",
     * tags={"Brand"},
     *
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *
     *    @OA\JsonContent(
     *
     *       @OA\Property(property="status", type="boolean", example="true"),
     *       @OA\Property(property="message", type="string", example="All Brand fetched"),
     *       @OA\Property(property="data", type="object"),
     *    )
     *   ),
     * )
     */
    public function index()
    {
        try {
            return $this->success('All brands', $this->brandService->getAllBrands());
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
