<?php

namespace App\Traits;

use App\Helpers\FileHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FileUpload
{

    /**
     * Upload a file to storage with optional thumbnail generation
     *
     * @param UploadedFile $file The file to upload
     * @param string|null $folder Target directory (defaults to config value)
     * @param string|null $filename Custom filename (generated if not provided)
     * @param string|null $disk Storage disk to use (defaults to config value)
     * @param bool $thumbnails Whether to generate thumbnails
     * @return array File path and thumbnail information
     */
    public function uploadFile(UploadedFile $file, ?string $folder = null, ?string $filename = null, ?string $disk = null, bool $thumbnails = false)
    {
        $disk = $disk ?? config('fileupload.default_disk');
        $folder = $folder ?? config('fileupload.default_folder');
        $thumbnailData = false;

        
        if (!Storage::disk($disk)->exists($folder)) {
            Storage::disk($disk)->makeDirectory($folder);
        }

        
        if (empty($filename)) {
            $folderPrefix = $folder === config('fileupload.default_folder') ? null : $folder;
            $filename = $this->generateUniqueFilename($file, $folderPrefix);
        }

        
        $path = $folder . '/' . $filename;
        Storage::disk($disk)->put($path, $file);

        
        if ($thumbnails && $file->isImage()) {
            $sizes = config('fileupload.thumbnails');
            $thumbnailData = FileHelper::createThumbnails($path, $sizes, $disk);
        }

        return [
            'path' => $path,
            'thumbnails' => $thumbnailData,
        ];
    }


    public function uploadMultipleFiles(array $files, ?string $folder = null, ?string $disk = null)
    {
        $uploadedFiles = [];

        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $path = $this->uploadFile($file, $folder, null, $disk);
                if ($path) {
                    $uploadedFiles[] = $path;
                }
            }
        }

        return $uploadedFiles;
    }

    /**
     * Delete a file from storage
     *
     * @param string $path
     * @param string|null $disk
     * @return bool
     */
    public function deleteFile(string $path, ?string $disk = null)
    {
        $disk = $disk ?? config('fileupload.default_disk');

        if (Storage::disk($disk)->exists($path)) {
            return Storage::disk($disk)->delete($path);
        }

        return false;
    }

    /**
     * Get file URL
     *
     * @param string $path
     * @param string|null $disk
     * @return string|null
     */
    public function getFileUrl(string $path, ?string $disk = null)
    {
        $disk = $disk ?? config('fileupload.default_disk');

        if (Storage::disk($disk)->exists($path)) {
            return Storage::disk($disk)->url($path);
        }

        return null;
    }


    public function generateUniqueFilename(UploadedFile $file, ?string $prefix = null)
    {
        $prefix = $prefix ?? Str::random(10);
        return $prefix . '_' . time() . '.' . $file->getClientOriginalExtension();
    }
}
