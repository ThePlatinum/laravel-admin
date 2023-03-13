<?php

namespace Platinum\LaravelAdmin;

use Illuminate\Support\ServiceProvider;
use Platinum\LaravelAdmin\Commands\AdminInstallCommand;
use Platinum\LaravelAdmin\Commands\SeedAdminCommand;

class LaravelAdminServiceProvider extends ServiceProvider
{
  public function boot()
  {
  }

  public function register()
  {
    if ($this->app->runningInConsole()) {
        $this->commands([
            AdminInstallCommand::class,
            SeedAdminCommand::class,
        ]);
    }
  }
}