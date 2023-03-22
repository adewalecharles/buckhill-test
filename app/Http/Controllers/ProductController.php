<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    protected $productService;

    /**
     * This controller construct
     *
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     * path="/products",
     * summary="Get products",
     * description="Get all products",
     * operationId="productsListing",
     * tags={"Product"},
     *  @OA\Parameter(name="limit", in="query", description="limit", required=false,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Parameter(name="page", in="query", description="the page number", required=false,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Parameter(name="desc", in="query", description="true or false", required=false,
     *        @OA\Schema(type="string")
     *    ),
     *      @OA\Parameter(name="q", in="query", description="search parameter", required=false,
     *        @OA\Schema(type="string")
     *    ),
     *    @OA\Parameter(name="sortBy", in="query", description="column to sort with, e.g id, title, price, created_at", required=false,
     *        @OA\Schema(type="string")
     *    ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status", type="boolean", example="true"),
     *       @OA\Property(property="message", type="string", example="All Products"),
     *       @OA\Property(property="data", type="object"),
     *    )
     *   ),
     * )
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->success('All Products',$this->productService->getAllProducts());
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Post(
     * path="/product",
     * summary="Create Product",
     * description="Create Product",
     * operationId="productCreate",
     * tags={"Product"},
     * security={ {"bearerAuth": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="Input Details",
     *    @OA\JsonContent(
     *       required={"title", "price", "description", "metadata", "category_uuid"},
     *       @OA\Property(property="title", type="string", example="Nike Shoe"),
     *       @OA\Property(property="price", type="numeric", example="192.10"),
     *       @OA\Property(property="description", type="string", example="A clean Nike shoe with Black lace"),
     *       @OA\Property(property="metadata", type="object"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status", type="boolean", example="true"),
     *       @OA\Property(property="message", type="string", example="Product Created"),
     *       @OA\Property(property="data", type="object"),
     *    )
     *  )
     * )
     */
    public function store(ProductRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->success('Product Created', $this->productService->createProduct($request->validated()));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @OA\Get(
     * path="/product/{uuid}",
     * summary="Get product",
     * description="Get a single product",
     * operationId="productList",
     * tags={"Product"},
     *  @OA\Parameter(name="uuid", in="path", description="uuid of product", required=true,
     *        @OA\Schema(type="string")
     *    ),
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
     *
     */
    public function show(string $uuid): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->success('Product Fetched', $this->productService->getProduct($uuid));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param string $uuid
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Put(
     * path="/product/{uuid}",
     * summary="Update product",
     * description="Update Product",
     * operationId="productUpdate",
     * tags={"Product"},
     * security={ {"bearerAuth": {} }},
     * @OA\Parameter(name="uuid", in="path", description="uuid of product", required=true,
     *        @OA\Schema(type="string")
     *    ),
     * @OA\RequestBody(
     *    required=true,
     *    description="Input Details",
     *    @OA\JsonContent(
     *       required={"title", "price","description","metadata","category_uuid"},
     *       @OA\Property(property="title", type="string", example="Nike Shoe"),
     *      @OA\Property(property="price", type="numeric", example="192.10"),
     *      @OA\Property(property="description", type="string", example="A clean Nike shoe with Black lace"),
     *       @OA\Property(property="metadata", type="object", example="{}"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status", type="boolean", example="true"),
     *       @OA\Property(property="message", type="string", example="File Uploaded"),
     *       @OA\Property(property="data", type="object"),
     *    )
     *   ),
     * )
     */
    public function update(ProductRequest $request, string $uuid): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->success('Product Fetched', $this->productService->updateProduct($request->validated(),$uuid));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $uuid
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Delete(
     * path="/product/{uuid}",
     * summary="Delete product",
     * description="Delete a single product",
     * operationId="deleteProduct",
     * tags={"Product"},
     * security={ {"bearerAuth": {} }},
     *  @OA\Parameter(name="uuid", in="path", description="uuid of product", required=true,
     *        @OA\Schema(type="string")
     *    ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status", type="boolean", example="true"),
     *       @OA\Property(property="message", type="string", example="Product Deleted"),
     *    )
     *   ),
     * )
     */
    public function destroy(string $uuid): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->success('Product Deleted', $this->productService->deleteProduct($uuid));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
