<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'git@github.com:klynicol/frozenza.git');

// Windows: SSH multiplexing causes "getsockname failed: Not a socket"
set('ssh_multiplexing', false);
set('git_tty', false);

// React
task('npm:install', function () {
    run('cd {{release_path}} && npm install');
});
task('npm:build', function () {
    run('cd {{release_path}} && npm run build');
});
after('deploy:update_code', 'npm:install');
after('npm:install', 'npm:build');

//sitemap
task('sitemap:generate', function () {
    run('cd {{release_path}} && php artisan app:generate-sitemap');
});
after('artisan:migrate', 'sitemap:generate');

// Inertia SSR (start Node SSR server)
task('inertia:ssr:restart', function () {
    // Restart so the SSR server picks up the newly built Vite SSR bundle.
    run('cd {{release_path}} && php artisan inertia:stop-ssr || true');
});
after('deploy:symlink', 'inertia:ssr:restart');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('15.204.137.142')
    ->set('remote_user', 'github')
    ->set('deploy_path', '/var/www/www.pizzakraken')
    ->set('branch', 'main');

// Hooks

after('deploy:failed', 'deploy:unlock');
