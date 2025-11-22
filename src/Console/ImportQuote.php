<?php

namespace Hzmwdz\Tinyquote\Console;

use Hzmwdz\Tinyquote\Imports\QuoteRuleImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportQuote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:quote {type : The type of quote to import}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import quote rules from the Excel file into the database.';

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
     * @return void
     */
    public function handle()
    {
        $type = $this->argument('type');

        $filePath = $this->getFilePath($type);

        Excel::import(new QuoteRuleImport($type), $filePath);

        $this->info('Imported successfully.');
    }

    /**
     * @param string $type
     * @return string
     */
    protected function getFilePath($type)
    {
        $filePath = $this->laravel->databasePath("imports/{$type}.xlsx");

        if (!file_exists($filePath)) {
            $this->error("File [$filePath] does not exist.");
            exit(1);
        }

        return $filePath;
    }
}
