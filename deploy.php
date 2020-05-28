<?php
namespace Deployer;

require 'recipe/codeigniter.php';

// Project name
set('application', 'my_project');

// Project repository
set('repository', 'git@gitlab.informatika.org:if3250-2020-lk-2/studium-generale-lk.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false);

// // Shared files/dirs between deploys 
// add('shared_files', []);
// add('shared_dirs', []);

// // Writable dirs by web server 
// add('writable_dirs', []);

// Define localhost
localhost()
    ->user('root')
    ->stage('production')
    ->roles('test')
    ->set('deploy_path', '/var/www/html/');

task('build', function () {
    run('cd {{release_path}} && build');
});

task('test', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
