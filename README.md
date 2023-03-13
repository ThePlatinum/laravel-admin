# Laravel Admin
Laravel Admin is a package that provides a ready-to-use admin model with authentication for Laravel applications. This allows to seperate the admin model from the user model and imporve code quality.
It also provides a simple plain Blade/Tailwind Admin Dashboard

## Installation
To install <b>Laravel Admin</b> , run the following command in your terminal:
```bash
composer require platinum/laravel-admin
```

## Usage
To use Laravel Admin

```bash
php artisan admin:install
```
This will create an Admin model, controller, routes, migration, and other setups you need to authenticat your admin.

You can provide the ```-m``` or ```--migrate``` option to run migrations or use the following command to migrate the database:
```bash
php artisan migrate
```
the create an admin using the following command:
```bash
php artisan admin:create

# It takes optional options: name, email and password
```
or you can write a factory/seed.

Login as an admin using ```{url}/admin/login```

## Customizations
To customize the appearance of the administration panel, you can modify the views and assets that were published during the installation process. These files are located in the public/vendor/laravel-admin directory.

### Admin role
The Admin model is fully available for you in the models dir, you can add more columns to the migration to implement roles.
I suggest using the [Spatie laravel-permission](https://spatie.be/docs/laravel-permission/) or other alternatives if you require more complexcity with the role management.


## Contributions
Contributions are **welcome** via Pull Requests on [Github](https://github.com/ThePlatinum/english-permutation).
- Please document any change you made as neccesary in the [README.md](README.md).
- Pleas make only one pull request per feature/fix.
- Please check the [Upcoming improvements](#improvements) section for ideas on what you can help with.


## Issues
This is my first laravel package, so, you may find it not perfect. Please report any issue you encounter in using the package through the issues tab [Github Issues](https://github.com/ThePlatinum/english-permutation/issues)


<div id='improvements'></div>

## Upcoming improvements:
- Password resets
- Manage Admins (CRUD)
- More UI Options:
  - React,
  - Bootstrap
  - Vue
- Password Confirmation
- Admin Profile
- More Dashboard Option
- Use subdomain instead of '/admin' routes


## Security
Laravel Admin includes security features to help protect your application. These features include authentication, authorization, and password hashing. However, it is still important to follow best practices for securing your application, such as using strong passwords and keeping your application up-to-date with the latest security patches.

## Credits
Laravel Admin was created by [Emmanuel Adesina]() and is licensed under the [MIT license](LICENSE.md).