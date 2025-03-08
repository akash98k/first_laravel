<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileHelper
{
    /**
     * Check if the file extension is allowed
     *
     * @param string $extension
     * @param string|null $type
     * @return bool
     */
    public static function isAllowedExtension(string $extension, ?string $type = null)
    {
        $allowedExtensions = config('fileupload.allowed_extensions');
        
        if ($type && isset($allowedExtensions[$type])) {
            return in_array(strtolower($extension), $allowedExtensions[$type]);
        }
        
        // Check in all defined types
        foreach ($allowedExtensions as $extensions) {
            if (in_array(strtolower($extension), $extensions)) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Get file type based on extension
     *
     * @param string $extension
     * @return string|null
     */
    public static function getFileTypeByExtension(string $extension)
    {
        $allowedExtensions = config('fileupload.allowed_extensions');
        
        foreach ($allowedExtensions as $type => $extensions) {
            if (in_array(strtolower($extension), $extensions)) {
                return $type;
            }
        }
        
        return null;
    }
    
    /**
     * Format file size for human reading
     *
     * @param int $bytes
     * @return string
     */
    public static function formatFileSize(int $bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }
    
    /**
     * Resize an image using Intervention Image
     *
     * @param string $path
     * @param int|null $width
     * @param int|null $height
     * @param bool $maintainAspect
     * @param string|null $disk
     * @return bool
     */
    public static function resizeImage(string $path, ?int $width = null, ?int $height = null, bool $maintainAspect = true, ?string $disk = null)
    {
        try {
            $disk = $disk ?? config('fileupload.default_disk');
            
            // Check if file exists
            if (!Storage::disk($disk)->exists($path)) {
                return false;
            }
            
            // Get file content
            $fileContent = Storage::disk($disk)->get($path);
            
            // Create image instance
            $img = Image::make($fileContent);
            
            // Resize image
            if ($maintainAspect) {
                $img->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            } else {
                $img->resize($width, $height);
            }
            
            // Save image
            Storage::disk($disk)->put($path, (string) $img->encode());
            
            return true;
        } catch (\Exception $e) {
            \Log::error('Image resize failed: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Create thumbnails for an image
     *
     * @param string $originalPath
     * @param array $sizes
     * @param string|null $disk
     * @return array
     */
    public static function createThumbnails(string $originalPath, array $sizes, ?string $disk = null)
    {
        $disk = $disk ?? config('fileupload.default_disk');
        $thumbnails = [];
        
        try {
            // Check if file exists
            if (!Storage::disk($disk)->exists($originalPath)) {
                return $thumbnails;
            }
            
            // Get file content
            $fileContent = Storage::disk($disk)->get($originalPath);
            
            // Get path info
            $pathInfo = pathinfo($originalPath);
            $extension = $pathInfo['extension'];
            $directory = $pathInfo['dirname'];
            $filename = $pathInfo['filename'];
            
            foreach ($sizes as $name => $dimensions) {
                $width = $dimensions['width'] ?? null;
                $height = $dimensions['height'] ?? null;
                
                $thumbPath = $directory . '/' . $filename . '_' . $name . '.' . $extension;
                
                // Create image instance
                $img = Image::make($fileContent);
                
                // Resize image
                $img->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                
                // Save thumbnail
                Storage::disk($disk)->put($thumbPath, (string) $img->encode());
                
                $thumbnails[$name] = $thumbPath;
            }
            
            return $thumbnails;
        } catch (\Exception $e) {
            \Log::error('Thumbnail creation failed: ' . $e->getMessage());
            return $thumbnails;
        }
    }
}
