<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OneTimeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:one-time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Anything';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $excel = \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\BrandsImport(), 'data/brands_elaborated.csv');
    }
}
