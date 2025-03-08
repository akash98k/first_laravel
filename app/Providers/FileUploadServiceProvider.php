<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FileUploadServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/fileupload.php', 'fileupload'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish configuration
        $this->publishes([
            __DIR__.'/../../config/fileupload.php' => config_path('fileupload.php'),
        ], 'fileupload-config');
    }
}
