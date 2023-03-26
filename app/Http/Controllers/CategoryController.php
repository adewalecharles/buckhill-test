<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryServiceInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(private CategoryServiceInterface $categoryService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     *
     * @OA\Get(
     * path="/categories",
     * summary="Get Categories",
     * description="Get all categories",
     * operationId="categoriesListing",
     * tags={"Category"},
     *
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *
     *    @OA\JsonContent(
     *
     *       @OA\Property(property="status", type="boolean", example="true"),
     *       @OA\Property(property="message", type="string", example="All Category fetched"),
     *       @OA\Property(property="data", type="object"),
     *    )
     *   ),
     * )
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->success('All Categories', $this->categoryService->getAllCategories());
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
