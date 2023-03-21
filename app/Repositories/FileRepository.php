<?php
namespace App\Repositories;

use App\Models\File;

class FileRepository
{

    /**
     * Get a single file using uuid
     *
     * @param string $uuid
     *
     * @return \App\Models\File
     */
    public function getFile(string $uuid): \App\Models\File
    {
        return File::where('uuid', $uuid)->first();
    }

    /**
     * upload a file and create a file record
     *
     * @param array $valid
     * @return \App\Models\File
     */
    public function uploadFile(array $valid): \App\Models\File
    {
        return File::create([
            'name' => $valid['file']->getClientOriginalName(),
            'type' => $valid['file']->getClientOriginalExtension(),
            'size' => $valid['file']->getSize(),
            'path' => $valid['file']->store('files', 'public')
        ]);

    }
}
