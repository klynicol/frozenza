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

// Inertia SSR (start Node SSR server)
task('inertia:ssr:restart', function () {
    // Restart so the SSR server picks up the newly built Vite SSR bundle.
    run('cd {{release_path}} && php artisan inertia:stop-ssr || true');

    // Start SSR server detached. Avoid `php artisan inertia:start-ssr` here since it is a long-running
    // foreground command and Deployer may try (and fail) to kill it.
    run('cd {{release_path}} && mkdir -p storage/logs && pkill -f "bootstrap/ssr/ssr\\.(js|mjs)" || true');
    run('cd {{release_path}} && nohup node bootstrap/ssr/ssr.js > storage/logs/inertia-ssr-start.log 2>&1 < /dev/null &');

    // Small pause so the SSR server can bind the port.
    run('cd {{release_path}} && sleep 1');
});
after('deploy:symlink', 'inertia:ssr:restart');

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
