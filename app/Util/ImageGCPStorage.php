<?php

namespace App\Util;

use App\Interfaces\ImageStorage;
use Google\Cloud\Storage\StorageClient;

class ImageGCPStorage implements ImageStorage 
{ 
    public function store($request, $imageName)
    {
        if($request->hasFile('image'))
        {
            $gcpKeyFile = file_get_contents(env('GCP_KEY_FILE'));
            $storage = new StorageClient(['keyFile' => json_decode($gcpKeyFile, true)]);
            $bucket = $storage->bucket(env('GCP_BUCKET'));
            $bucket->upload(
                file_get_contents($request->file('image')->getRealPath()),
                ['name' => $imageName] 
            );
        }
    }       
}