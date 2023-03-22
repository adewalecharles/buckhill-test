<?php

namespace App\Repositories;

use App\Models\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FileRepository
{
    /**
     * Get a single file using uuid
     *
     *
     * @return \App\Models\File
     */
    public function getFile(string $uuid): ?File
    {
        $file = File::where('uuid', $uuid)->first();

        if (! $file) {
            throw new ModelNotFoundException('File is not found', 404);
        }

        return $file;
    }

    /**
     * upload a file and create a file record
     *
     * @return \App\Models\File
     */
    public function uploadFile(array $valid): ?File
    {
        return File::create([
            'name' => $valid['file']->getClientOriginalName(),
            'type' => $valid['file']->getClientOriginalExtension(),
            'size' => $valid['file']->getSize(),
            'path' => $valid['file']->store('files', 'public'),
        ]);
    }
}
