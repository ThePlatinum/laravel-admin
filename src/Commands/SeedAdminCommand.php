<?php

namespace Platinum\LaravelAdmin\Commands;

use Illuminate\Console\Command;

class SeedAdminCommand extends Command
{
    protected $signature = 'admin:seed 
      {--name= : The name of the admin}
      {--email= : The email of the admin}
      {--password= : Password for the admin user}';
    protected $description = 'Seed an admin with optional parameters for name, email, and password.';

    public function handle()
    {
        $adminModel = app('App\Models\Admin');
        if (!$adminModel) {
            $this->error('The Admin model does not exist. Create it using the admin:install command.');
            return;
        }

        $name = $this->option('name') ?: $this->ask('Enter the admin name', fake()->name());
        $email = $this->option('email') ?: $this->ask('Enter the admin email', fake()->safeEmail());
        $password = $this->option('password') ?: $this->ask('Enter the admin password', fake()->password(8, 10));

        $this->comment("Seeding admin...");

        $admin = $adminModel->create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        $this->info("Admin seeded with name: '{$name}', email: '{$admin->email}' and password: '{$password}'.");
    }
}
