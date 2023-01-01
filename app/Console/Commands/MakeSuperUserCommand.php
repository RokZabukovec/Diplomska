<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeSuperUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'super-user:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a new super user.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
