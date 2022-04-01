<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait ImageTrait
{
    /**
     * Store image in the storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $fieldName
     * @param  string  $directory
     * @throws Exception If an image could not be uploaded.
     * @return string
     */
    public function storeImage(Request $request, $fieldName = 'image', $directory = 'unknown')
    {
        if ($request->file($fieldName)->isValid()) {
            $extension = $request->file($fieldName)->getClientOriginalExtension();
            $fileNameToStore = rand(10000, 100000).time().'.'.$extension;
            $request->file($fieldName)->storeAs('public/uploads/'.$directory, $fileNameToStore);

            return $fileNameToStore;
        }

        throw new Exception;
    }

    /**
     * Delete image from the storage.
     *
     * @param  string  $directory
     * @param  string  $model
     * @param  string  $fieldName
     * @param  bool    $hasDefaultImage
     * @return bool
     */
    public function deleteImage($directory, $model, $fieldName, $hasDefaultImage = false)
    {
        Storage::delete('public/uploads/'.$directory.'/'.$model->getOriginal($fieldName));

        if ($hasDefaultImage) {
            $model->update([
                $fieldName => 'default.png'
            ]);
        }

        return true;
    }
}