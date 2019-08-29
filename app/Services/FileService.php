<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class FileService
{
    private const DEFAULT_FILES_URL= [
        "/storage/default/profileImage.png"
    ];

    public function getDefaultFilesUrl(): array {
        return self::DEFAULT_FILES_URL;
    }

    public function saveFile(UploadedFile $file, string $fileStorageFolder): string
    {
        return $file->store($fileStorageFolder);
    }

	public function saveAndOptimizeImage(UploadedFile $file, string $fileStorageFolder, int $widthToResize = 1200): string
	{
		$pathToSavedFile = self::saveFile($file, $fileStorageFolder);
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

    public function removeFileUsingFileUrl(string $fileUrl) {
        if(Str::length($fileUrl) <= 0 || !Str::contains($fileUrl,"/storage/"))
            throw new \Exception("File url must be a valid url including /storage/ word");

        if(in_array($fileUrl, $this->getDefaultFilesUrl()))
            return;

        $fileUrlWithoutStorage =  Str::replaceFirst("/storage/","",$fileUrl);

        if(Storage::exists($fileUrlWithoutStorage)){
            Storage::delete($fileUrlWithoutStorage);
        }
    }
}
