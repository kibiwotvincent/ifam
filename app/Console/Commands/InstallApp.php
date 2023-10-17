<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\App;

class InstallApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perform initial app setup';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(App $app)
    {
        $this->info('Please provide enter email and set password to create admin account.');
        $email = $this->ask('Enter admin email...');
        $app->saveAdminDetails('admin_email', $email);
        
        $password = $this->ask('Enter admin password...');
        $app->saveAdminDetails('admin_password', $password);
        
        $confirmPassword = $this->ask('Confirm admin password...');
        if($app->confirmAdminPassword($confirmPassword)) {
            $this->info('Please wait as the app is being set up.');
            $app->setPermissions();
            if($app->createAdmin()) {
                $this->info('App has been set up successfully. Login with your admin credentials and finish up on other settings.');
            }
            else {
                $this->info('Setup error. Please run app:install command again!');
            }
        }
        else {
            $this->info('Admin password does not match. Please run app:install command again!');
        }
    }
}
