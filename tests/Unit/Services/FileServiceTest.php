<?php

namespace Tests\Unit\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Core\Services\FileService;

class FileServiceTest extends TestCase
{
    use RefreshDatabase;

    private FileService $fileService;

    public function setUp(): void {
        parent::setUp();
        $this->fileService = $this->app->make(FileService::class);
    }

    public function testSaveAndOptimizeFile(): void {
        $storageFolder = 'photo';
        $fileName = 'photo1.jpg';
        $uploadedFile = UploadedFile::fake()->image($fileName);
        Storage::fake('local');

        $returnedPath = $this->fileService
            ->saveAndOptimizeImage($uploadedFile, $storageFolder, 758);

        Storage::disk('local')
            ->assertExists($returnedPath);
    }

    public function testRemoveFileUsingFileUrl(): void {
        $storageFolder = 'photo';
        $fileName = 'photo1.jpg';
        $uploadedFile = UploadedFile::fake()->image($fileName);
        Storage::fake('local');

        $returnedPath = $this->fileService
            ->saveAndOptimizeImage($uploadedFile, $storageFolder);

        $fileUrl = Storage::url($returnedPath);

        $this->fileService
            ->removeFileUsingFileUrl($fileUrl);

        Storage::disk('local')
            ->assertMissing($returnedPath);
    }

    public function testRemoveFileUsingFileUrlWithDefaultString(): void {
        $defaultFileUrl = $this->fileService::DEFAULT_FILES_URL[0];

        $this->assertNotNull($defaultFileUrl);

        $this->fileService
            ->removeFileUsingFileUrl($defaultFileUrl);
    }

    public function testThrowExceptionWhenTryToRemoveFIleUsingBadUrl(): void {
        $this->expectException(\Exception::class);

        $this->fileService
            ->removeFileUsingFileUrl('bad/file/url');
    }
}
