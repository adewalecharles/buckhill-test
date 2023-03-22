<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Services\FileService;
use DB;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * @var FileService
     */
    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * upload and create a file
     *
     * @param UploadFileRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\POST(
     * path="/file",
     * summary="Create File",
     * description="Create file",
     * operationId="fileCreate",
     * tags={"File"},
     * security={ {"bearer": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="Input Details",
     *    @OA\JsonContent(
     *       required={"file"},
     *       @OA\Property(property="file", type="file"),
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
    public function store(UploadFileRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            DB::beginTransaction();
            $response =  $this->fileService->uploadFile($request->validated());
            DB::commit();
            return $this->success('File Uploaded', $response);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Get a single file
     *
     * @param string $uuid
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     * path="/file/{uuid}",
     * summary="Get file",
     * description="Get a single file",
     * operationId="fileList",
     * @OA\Parameter(name="uuid", in="path", description="uuid of file", required=true,
     *        @OA\Schema(type="string")
     *    ),
     * tags={"File"},
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status", type="boolean", example="true"),
     *       @OA\Property(property="message", type="string", example="All file fetched"),
     *       @OA\Property(property="data", type="object"),
     *    )
     *   ),
     * )
     */
    public function show(string $uuid): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->success('File fetched successfully', $this->fileService->getFile($uuid));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
