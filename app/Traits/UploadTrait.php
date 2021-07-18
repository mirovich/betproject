<?php


namespace App\Traits;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait UploadTrait
{
    public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(25);

        $file = $uploadedFile->storeAs($folder, $name . '.' . $uploadedFile->getClientOriginalExtension(), $disk);

        return $file;
    }

    public function uploadToStorage($url, $name, $disk = 'public')
    {
        $contents = file_get_contents($url);
        if (\Storage::disk($disk)->put($name, $contents)) {
            return \Storage::disk($disk)->url($name);
        }
        return 'empty.jpg';
    }
}
