<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'git@github.com:klynicol/frozenza.git');

// React
task('npm:install', function () {
    run('cd {{release_path}} && npm install');
});
task('npm:build', function () {
    run('cd {{release_path}} && npm run build');
});
after('deploy:update_code', 'npm:install');
after('npm:install', 'npm:build');

// composer
task('composer:install', function () {
    run('cd {{release_path}} && composer install');
});
after('artisan:migrate', 'composer:install');

//sitemap
task('sitemap:generate', function () {
    run('cd {{release_path}} && php artisan app:generate-sitemap');
});
after('composer:install', 'sitemap:generate');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('68.46.84.167')
    ->set('remote_user', 'mark')
    ->set('deploy_path', '/var/www/www.pizzakraken.com')
    ->set('branch', 'main');

// Hooks

after('deploy:failed', 'deploy:unlock');
