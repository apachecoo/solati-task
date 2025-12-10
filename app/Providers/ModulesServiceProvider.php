<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class ModulesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $modulesPath = app_path('Modules');

        if (!File::isDirectory($modulesPath)) {
            return;
        }

        foreach (File::directories($modulesPath) as $modulePath) {
            $migrationPath = $modulePath . '/Infrastructure/Persistence/Migrations';
            if (File::isDirectory($migrationPath)) {
                $this->loadMigrationsFrom($migrationPath);
            }
        }
    }

    public function boot(): void
    {
        // $modulesPath = app_path('Modules');

        // if (!File::isDirectory($modulesPath)) {
        //     return;
        // }
        
        // foreach (File::directories($modulesPath) as $modulePath) {
        //     $routesPath = $modulePath . '/Infrastructure/Http/routes.php';
            
        //     if (File::isFile($routesPath)) {
                
        //         $moduleName = basename($modulePath); 
                
        //         Route::middleware('api')
        //             ->prefix(strtolower($moduleName))
        //             ->group(function () use ($routesPath) {
        //                 $this->loadRoutesFrom($routesPath);
        //             });
        //     }
        // }
    }
}