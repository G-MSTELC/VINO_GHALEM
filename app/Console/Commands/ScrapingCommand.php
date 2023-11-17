<?php

namespace App\Console\Commands;

use App\Http\Controllers\Web2scraperController;
use Illuminate\Http\Request;
use Illuminate\Console\Command;

class ScrapingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraping:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importer les donnee a minuit';

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
        // Instancier le Web2scraperController
        $scraperController = new Web2scraperController;
        $request = new Request();
        $scraperController->scrapeData($request);

        $this->info('Web scraping completed successfully.');
    }
}
