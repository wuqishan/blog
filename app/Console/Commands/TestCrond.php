<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCrond extends Command
{
    protected $signature = 'command:test';

    protected $description = '测试';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        file_put_contents('/test_crond.txt', date('Y-m-d H:i:s') . "\n", 8);
    }
}

