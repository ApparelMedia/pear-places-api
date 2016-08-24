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

after('deploy:symlink', 'copy:dotenv');

// Production Server
$stageName = 'production';
server('prod1', 'prod1.places')
    ->configFile('/home/vagrant/.ssh/config')
    ->env('deploy_path', '/opt/pear-places-api')
    ->env('stage_name', $stageName)
    ->stage($stageName);

// Staging Server
$stageName = 'staging';
server('stage1', 'stage1.places')
    ->configFile('/home/vagrant/.ssh/config')
    ->env('deploy_path', '/opt/pear-places-api')
    ->env('stage_name', $stageName)
    ->stage($stageName);