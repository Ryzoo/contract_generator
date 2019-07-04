<?php
/**
 * Created by PhpStorm.
 * User: ryzoo
 * Date: 05.03.19
 * Time: 20:21
 */

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class FileService
{
    public function saveFile(UploadedFile $file, $fileStorageFolder): ?string
    {
        if(!isset($file)) return null;
        return "/storage/" . $file->store($fileStorageFolder);
    }

	public function saveAndOptimizeImage(UploadedFile $file, string $fileStorageFolder, int $resize = 1200)
	{
		$path = self::saveFile($file, $fileStorageFolder);

		if($path){
			$fullPath = public_path() . $path;

			Image::make($file)
				->resize($resize, null, function ($constraint) {
					$constraint->aspectRatio();
					$constraint->upsize();
				})
				->save($fullPath);

			ImageOptimizer::optimize($fullPath);
		}

		return $path;
    }

    public function tryRemoveFileByStorageUrl(string $fileUrl) {
        if(!isset($fileUrl) || Str::length($fileUrl) === 0) return null;
        $fullPath = Str::replaceFirst("/","",$fileUrl);
        $fullPath =  str_replace("/","\\",$fullPath) ;
        $fullPath =  str_replace("storage\\","",$fullPath) ;
        Storage::disk('public')->delete($fullPath);
    }
}