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
        $this->$fileService = $fileService;
    }


    public function store(UploadFileRequest $request)
    {
        try {
            DB::beginTransaction();
            $response = $this->success('File uploaded', $this->fileService->uploadFile($request->validated()));
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
