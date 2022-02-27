<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ScrapListUrl;
use App\Jobs\SaveProperty;

use App\Models\ListUrl; 


class ScrapManage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Web Scraping';

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
       // for($i = 1; $i<10 ;$i++){ 
           $i = 1;
           $typecategoryid = 1;  
           $job = (new ScrapListUrl($i,$typecategoryid));
           dispatch($job)->delay(now()->addMinutes(1));

       // }

       // for($i = 1; $i<10 ;$i++){ 
            $i = 1;
            $typecategoryid = 6;  
            $job = (new ScrapListUrl($i,$typecategoryid));
            dispatch($job)->delay(now()->addMinutes(1));
       // }
        //for  type sale (1) 
        //for  type rent (6) 
     
        return 0;
    }
}
