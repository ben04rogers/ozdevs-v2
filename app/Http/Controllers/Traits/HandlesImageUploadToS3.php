<?php

namespace App\Http\Controllers\Traits;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

trait HandlesImageUploadToS3
{
    public function handleTheImageUploadToS3($request, mixed $data, string $prefix = 'profile_image_'): mixed
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            try {
                $uploadedImage = $request->file('image');

                // Generate a unique filename
                $fileName = $prefix.time().'.'.$uploadedImage->getClientOriginalExtension();

                // Use the store method to store the file in the root of the 's3' disk
                $imagePath = $uploadedImage->storeAs('', $fileName, 's3');

                $s3Url = Storage::disk('s3')->url($imagePath);

                $data['image'] = $s3Url;
            } catch (Exception $e) {
                Log::error($e->getMessage());
            }
        }

        return $data;
    }
}
