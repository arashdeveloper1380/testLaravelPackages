<?php

use Illuminate\Console\Command;

class Serve extends Command
{
    protected $signature = 'serve';
    protected $description = 'Start Serve';

    public function handle()
    {
       shell_exec('php -S localhost:8000');
    }
}