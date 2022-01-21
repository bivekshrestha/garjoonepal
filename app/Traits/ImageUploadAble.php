<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

/**
 * Trait ImageUploadAble
 * @package App\Traits
 */
trait ImageUploadAble
{
    /**
     * @param UploadedFile $file
     * @param $folder
     * @param integer $width
     * @param integer $height
     * @return false|string
     */
    public function uploadImage(UploadedFile $file, $folder, $width = 600, $height = 600)
    {
        $name = 'img_' . md5(uniqid() . microtime());
        $image = $file->storeAs('images/' . $folder, $name . '.' . $file->getClientOriginalExtension());

        Image::make(storage_path() . '/app/' . $image)
            ->fit($width, $height, function ($constraint) {
                $constraint->upsize();
            })
            ->save();

        return $image;
    }

    /**
     * @param null $path
     */
    public function deleteImage($path = null)
    {
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
    }
}
