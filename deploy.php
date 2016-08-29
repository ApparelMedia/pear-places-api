<?php namespace Deployer;

require 'recipe/laravel.php';

set('ssh_type', 'ext-ssh2');
set('default_stage', 'staging');

// Set configurations
set('repository', 'git@github.com:ApparelMedia/pear-places-api.git');
set('writable_dirs', ['storage']);
set('writable_use_sudo', false);
set('shared_files', ['.env']);
set('shared_dirs', [
    'storage/app',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
]);

task('copy:dotenv', function () {
    $sourceDotEnv = env('deploy_path') . '/shared/.env.' . env('stage_name');
    $targetDotEnv = env('deploy_path') .'/shared/.env';
    run("cp $sourceDotEnv $targetDotEnv");
})->desc('Copying .env file from file published by CI WebOps');

task('opcache:clear', function () {
    $adapter = new \CacheTool\Adapter\FastCGI('127.0.0.1:9000', $tempDir = '/tmp');
    $cache = \CacheTool\CacheTool::factory($adapter);
    $cache->opcache_reset();
})->desc('Clear OpCache');

after('deploy:symlink', 'copy:dotenv');

/**
 * Main task (Overwritting Default Laravel Task
 */
task('deploy', [
    'deploy:prepare',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:writable',
    'deploy:symlink',
    'cleanup',
    'artisan:cache:clear',
    'opcache:clear',
    'success',
])->desc('Deploy your project');

// Production Server
server('prod1', 'prod1.places')
    ->configFile('/home/vagrant/.ssh/config')
    ->env('deploy_path', '/opt/pear-places-api')
    ->env('stage_name', 'production')
    ->stage('production');

server('prod2', 'prod2.places')
    ->configFile('/home/vagrant/.ssh/config')
    ->env('deploy_path', '/opt/pear-places-api')
    ->env('stage_name', 'production')
    ->stage('production');

// Staging Server
server('stage1', 'stage1.places')
    ->configFile('/home/vagrant/.ssh/config')
    ->env('deploy_path', '/opt/pear-places-api')
    ->env('stage_name', 'staging')
    ->stage('staging');