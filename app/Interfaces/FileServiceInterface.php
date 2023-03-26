<?php

namespace App\Interfaces;

interface FileServiceInterface
{
    /**
     * Get a file using the uuid
     */
    public function getFile(string $uuid): \Illuminate\Http\Resources\Json\JsonResource;

    /**
     * Upload a file
     */
    public function uploadFile(array $valid): \Illuminate\Http\Resources\Json\JsonResource;
}
