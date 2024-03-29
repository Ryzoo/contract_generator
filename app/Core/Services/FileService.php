<?php
namespace App\Core\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Whoops\Exception\ErrorException;

class FileService
{
    public const DEFAULT_FILES_URL= [
      '/storage/default/profileImage.png'
    ];

	public function saveAndOptimizeImage(UploadedFile $file, string $fileStorageFolder, int $widthToResize = 1200): string
	{
		$pathToSavedFile = $file->store($fileStorageFolder);
        $fullFilePath = Storage::path($pathToSavedFile);

        Image::make($file)
            ->resize($widthToResize, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->save($fullFilePath);

        ImageOptimizer::optimize($fullFilePath);

		return $pathToSavedFile;
    }

    public function removeFileUsingFileUrl(string $fileUrl): void {
        if(Str::length($fileUrl) <= 0 || !Str::contains($fileUrl, '/storage/')) {
          throw new ErrorException('File url must be a valid url including /storage/ word');
        }

        if(in_array($fileUrl, FileService::DEFAULT_FILES_URL)) {
          return;
        }

        $fileUrlWithoutStorage =  Str::replaceFirst('/storage/', '',$fileUrl);

        if(Storage::exists($fileUrlWithoutStorage)){
            Storage::delete($fileUrlWithoutStorage);
        }
    }
}
