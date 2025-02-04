<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImportSqlFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-sql';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import SQL files from storage/app/private into the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $files = Storage::files('geo');

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'sql') {
                $this->info("Importing {$file}...");

                $sql = Storage::get($file);
                DB::unprepared($sql);

                $this->info("Imported {$file} successfully.");
            }
        }

        $this->info('All SQL files have been imported.');
    }
} 