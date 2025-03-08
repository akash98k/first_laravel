<?php

// File Upload Routes
Route::prefix('files')->group(function () {
    Route::post('/upload', [\App\Http\Controllers\FileUploadController::class, 'upload']);
    Route::post('/upload-multiple', [\App\Http\Controllers\FileUploadController::class, 'uploadMultiple']);
    Route::post('/delete', [\App\Http\Controllers\FileUploadController::class, 'delete']);
});
