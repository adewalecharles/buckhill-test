<?php

namespace App\Services;

use App\Http\Resources\FileResource;
use App\Repositories\FileRepository;

class FileService
{
    /**
     * @var FileRepository
     */
    protected $fileRepository;

    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    /**
     * Get a file using the uuid
     */
    public function getFile(string $uuid): \Illuminate\Http\Resources\Json\JsonResource
    {
        return new FileResource($this->fileRepository->getFile($uuid));
    }

    /**
     * Upload a file
     */
    public function uploadFile(array $valid): \Illuminate\Http\Resources\Json\JsonResource
    {
        return new FileResource($this->fileRepository->uploadFile($valid));
    }
}
