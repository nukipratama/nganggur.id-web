<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class MarkVerifiedUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:verify {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark User as Verified';

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
    public function handle()
    {
        $user = User::with('partner')->where('email', $this->argument('email'))->first();

        if (!$user instanceof User) {
            $this->error('User not found!');
            exit();
        }

        $user->email_verified_at = now();
        $user->save();

        if ($user->isPartner()) {
            $user->partner->verified_at = now();
            $user->partner->save();
        }

        $this->info("User {$user->email} was successfully verified.");
    }
}
