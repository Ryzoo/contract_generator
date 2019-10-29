<?php

namespace Tests\Unit\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileServiceTest extends TestCase
{
    use RefreshDatabase;

    /***
     * @var \App\Core\Services\FileService
     */
    private $fileService;

    public function setUp(): void {
        parent::setUp();
        $this->fileService = $this->app->make('App\Core\Services\FileService');
    }

    public function testSaveFileToFolder()
    {
        $storageFolder = 'photo';
        $fileName = 'photo1.jpg';
        $uploadedFile = UploadedFile::fake()->image($fileName);
        Storage::fake('local');

        $returnedPath = $this->fileService
            ->saveFile($uploadedFile, $storageFolder);

        Storage::disk('local')
            ->assertExists($returnedPath);
    }

    public function testSaveAndOptimizeFile()
    {
        $storageFolder = 'photo';
        $fileName = 'photo1.jpg';
        $uploadedFile = UploadedFile::fake()->image($fileName);
        Storage::fake('local');

        $returnedPath = $this->fileService
            ->saveAndOptimizeImage($uploadedFile, $storageFolder, 758);

        Storage::disk('local')
            ->assertExists($returnedPath);
    }

    public function testRemoveFileUsingFileUrl()
    {
        $storageFolder = 'photo';
        $fileName = 'photo1.jpg';
        $uploadedFile = UploadedFile::fake()->image($fileName);
        Storage::fake('local');

        $returnedPath = $this->fileService
            ->saveFile($uploadedFile, $storageFolder);

        $fileUrl = Storage::url($returnedPath);

        $this->fileService
            ->removeFileUsingFileUrl($fileUrl);

        Storage::disk('local')
            ->assertMissing($returnedPath);
    }

    public function testRemoveFileUsingFileUrlWithDefaultString()
    {
        $defaultFileUrl = $this->fileService::DEFAULT_FILES_URL[0];

        $this->assertNotNull($defaultFileUrl);

        $this->fileService
            ->removeFileUsingFileUrl($defaultFileUrl);

    }

    public function testThrowExceptionWhenTryToRemoveFIleUsingBadUrl()
    {
        $this->expectException(\Exception::class);

        $this->fileService
            ->removeFileUsingFileUrl("bad/file/url");
    }
}
