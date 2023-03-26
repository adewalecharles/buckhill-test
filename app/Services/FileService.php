<?php

namespace App\Services;

use App\Http\Resources\FileResource;
use App\Interfaces\FileRepositoryInterface;
use App\Interfaces\FileServiceInterface;

class FileService implements FileServiceInterface
{
    public function __construct(private FileRepositoryInterface $fileRepository)
    {
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
