<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\BufferedOutput;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install {--dev}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The install application will take basic information to have the server setup';


    /**
     * Setup site with dummy data and in dev mode
     * 
     * @var bool
     */
    protected $devMode = false;

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
    public function handle(): int
    {
        $this->devMode = (bool) $this->option('dev');

        $this->migrate();
        $this->setupUser();
        $this->passportInstall()->seed();

        $this->info('Installation completed...');
        $this->line('Make sure to get the Client ID and and Client Secret for Passport Password Grant');

        return 0;
    }

    /**
     * Run Laravel Migrations
     * 
     * @return void
     */
    protected function migrate()
    {
        $this->info('Migrating and Refreshing Database tables...');

        $output = new BufferedOutput;

        Artisan::call('migrate:refresh', [], $output);

        $this->line($output->fetch());

        return $this;
    }

    /**
     * Run Passport install
     */
    protected function passportInstall()
    {
        $this->info('Installing Passport...');
        $output = new BufferedOutput;

        Artisan::call('passport:install --force', [], $output);

        $this->info('Passport output:');
        $this->line($output->fetch());

        return $this;
    }

    /**
     * Run Laravel Seeder
     */
    protected function seed()
    {
        $this->info('Seeding Tables...');

        $output = new BufferedOutput;

        Artisan::call('db:seed', [], $output);

        $this->line($output->fetch());

        return $this;
    }

    /**
     * Collect account information and create a user profile
     * 
     * @return void
     */
    protected function setupUser()
    {
        // Account details
        $this->info('Set up new user account');
        $user['firstname'] = $this->ask('What is your first name?');
        $user['lastname'] = $this->ask('What is your last name?');
        $user['email'] = $this->ask('What is your email?');
        $user['password'] = $this->setupPassword();

        // Output details to user
        $this->line('Account ready to be created...');
        $this->line("Name: {$user['firstname']} {$user['lastname']}");
        $this->line("Email: {$user['email']}");
        $this->line("Password: {$user['password']}");

        // Confirm & setup account
        if ($this->confirm('Does the information look correct?', true))
        {
            $account = User::create($user);

            // confirm account has been created
            if ($account)
            {
                $this->info('Account created successfully!');
                return $user;
            }
            else
            {
                $this->error('Account could not be created at this time. Try again.');
                return;
            }
        }
        else
        {
            return $this->setupUser();
        }
    }

    /**
     * Setup the user password with requirements
     * 
     * @return void
     */
    protected function setupPassword()
    {
        $password = $this->secret('Choose a password');
        $password_confirm = $this->secret('Confirm your password');

        // Empty password
        if (empty($password)) {
            $this->error('Password cannot be left blank!');
            return $this->setupPassword();
        }

        // Password mismatch
        if ($password !== $password_confirm) {
            $this->error('Passwords do not match... Try again.');
            return $this->setupPassword();
        }

        // return hashed password
        return Hash::make($password);
    }
}
