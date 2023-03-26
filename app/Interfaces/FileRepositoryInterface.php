<?php

namespace App\Interfaces;

use App\Models\File;

interface FileRepositoryInterface
{
    /**
     * Get a single file using uuid
     *
     * @return \App\Models\File
     */
    public function getFile(string $uuid): ?File;

    /**
     * upload a file and create a file record
     *
     *
     * @return \App\Models\File
     */
    public function uploadFile(array $valid): ?File;
}
