<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | for file uploads throughout your application.
    |
    */
    'default_disk' => env('FILE_UPLOAD_DISK', 'public'),

    /*
    |--------------------------------------------------------------------------
    | Default Upload Folder
    |--------------------------------------------------------------------------
    |
    | This value determines the default folder where uploaded files will be stored.
    |
    */
    'default_folder' => env('FILE_UPLOAD_FOLDER', 'uploads'),

    /*
    |--------------------------------------------------------------------------
    | Allowed File Extensions
    |--------------------------------------------------------------------------
    |
    | List of allowed file extensions for uploading.
    |
    */
    'allowed_extensions' => [
        'images' => ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'],
        'documents' => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt'],
        'videos' => ['mp4', 'avi', 'mov', 'wmv'],
        'audio' => ['mp3', 'wav', 'ogg'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Max File Size (in kilobytes)
    |--------------------------------------------------------------------------
    */
    'max_file_size' => [
        'image' => 5120, // 5MB
        'document' => 10240, // 10MB
        'video' => 102400, // 100MB
        'audio' => 10240, // 10MB
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Image Settings
    |--------------------------------------------------------------------------
    */
    'image' => [
        'resize' => [
            'enabled' => true,
            'width' => 1200,
            'height' => null, // null for auto height
            'maintain_aspect' => true,
        ],
        'thumbnails' => [
            'create' => true,
            'sizes' => [
                'small' => ['width' => 150, 'height' => 150],
                'medium' => ['width' => 300, 'height' => 300],
                'large' => ['width' => 600, 'height' => 600],
            ],
        ],
    ],
];
