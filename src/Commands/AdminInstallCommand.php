<?php

namespace Platinum\LaravelAdmin\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class AdminInstallCommand extends Command
{
    protected $signature = 'admin:install {--m|migrate : Indicate to run the migration after installing}';
    protected $description = 'Install laravel-admin and setup its configurations';

    public function handle()
    {
        $this->info('Installing...');

        $this->createGuard();

        $this->createAdminModel();

        $this->createMigration();

        $this->createController();

        $this->createAuthRoutes();

        $this->createRegisterAuthRoutes();

        $this->replaceRedirectIfAuthenticatedMiddleware();

        $this->replaceAuthenticatMiddleware();

        $this->createUis();

        if ($this->option('migrate')) {
            $this->info('Running migration...');
            Artisan::call('migrate', ['--force' => true]);
        }

        $this->line('');
        $this->info('Admin setup successfull!');
    }

    protected function createGuard()
    {
        $authConfigPath = config_path('auth.php');

        $authConfig = File::get($authConfigPath);
        $newGuard = str_replace(
            "'guards' => [",
            "'guards' => [
                'admin' => [
                    'driver' => 'session',
                    'provider' => 'admins',
                ],
            ",
            $authConfig
        );

        File::put($authConfigPath, $newGuard);
    }

    protected function createAdminModel()
    {
        $modelPath = app_path('Models/Admin.php');
    
        if (File::exists($modelPath)) {
            $this->error('The Admin model already exists.');
            return;
        }
    
        $stubPath = dirname(__DIR__, 2) . '/stubs/model/Admin.php';
        copy($stubPath, $modelPath);
    }

    protected function createMigration()
    {
      $migrationName = 'create_admins_table';
      $timestamp = date('Y_m_d_His');
      $migrationPath = database_path("migrations/{$timestamp}_{$migrationName}.php");
  
      if (File::exists($migrationPath)) {
          $this->error('The Admin migration already exists.');
          return;
      }
  
      $stubPath = dirname(__DIR__, 2) . '/stubs/migrations/create_admins_table.php';
      copy($stubPath, $migrationPath);
    }

    protected function createController()
    {
      $filesystem = new Filesystem;
      $source = __DIR__.'/../../stubs/controllers';
      $destination = app_path('Http/Controllers');

      $filesystem->ensureDirectoryExists($destination);
      $filesystem->copyDirectory($source, $destination);
    }

    protected function createAuthRoutes()
    {
      $modelPath = base_path('routes/admin.php');
  
      if (File::exists($modelPath)) {
          $this->error('The Admin routes already exists.');
          return;
      }
  
      $stubPath = dirname(__DIR__, 2) . '/stubs/routes/admin.php';
      copy($stubPath, $modelPath);
    }

    protected function createRegisterAuthRoutes()
    {
      $routeServiceProviderPath = app_path('Providers/RouteServiceProvider.php');

      $provider = File::get($routeServiceProviderPath);
      $newProvider = str_replace(
          "this->routes(function () {",
          "this->routes(function () {
            
              Route::middleware('web')
                // ->domain('admin.' . preg_quote(str_replace(['http://', 'https://', 'www.'], '', config('app.url')), '/') . '$')
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));
          ",
          $provider
      );

      File::put($routeServiceProviderPath, $newProvider);
    }

    protected function createUis()
    {
      $filesystem = new Filesystem;
      $source = __DIR__.'/../../stubs/views';
      $destination = resource_path('views');

      $filesystem->ensureDirectoryExists($destination);
      $filesystem->copyDirectory($source, $destination);
    }

    protected function replaceRedirectIfAuthenticatedMiddleware()
    {
        $source = __DIR__ . '/../../stubs/middleware/RedirectIfAuthenticated.php';
        $destination = app_path('Http/Middleware/RedirectIfAuthenticated.php');

        File::copy($source, $destination);
    }

    protected function replaceAuthenticatMiddleware()
    {
        $source = __DIR__ . '/../../stubs/middleware/Authenticate.php';
        $destination = app_path('Http/Middleware/Authenticate.php');

        File::copy($source, $destination);
    }
}
