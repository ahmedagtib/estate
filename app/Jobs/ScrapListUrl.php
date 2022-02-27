<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use  App\Models\ListUrl;
use  App\Models\Property;
use App\Jobs\SaveProperty;

class ScrapListUrl implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public $page;
    public $typecategoryid;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($page,$typecategoryid)
    {
       $this->page = $page;
       $this->typecategoryid = $typecategoryid;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

            $response = Http::get('https://www.avendrealouer.fr/recherche.html?pageIndex='.$this->page.'&sortPropertyName=ReleaseDate&sortDirection=Descending&searchTypeID=1&typeGroupCategoryID='.$this->typecategoryid.'&localityIds=2-42,2-72,2-83,2-25,2-26,2-53,2-24,2-21,2-94,2-43,2-23,2-11,2-91,2-74,2-41,2-73,2-31,2-52,2-22,2-54&typeGroupIds=1,2,3,4,5,6,7,8,9,10,11&searchId=client-637584014457120000&hasAlert=false');
            // preg_match_all('/<a href="\/vente\/(.*?).html"/is',$response,$out);
            preg_match_all('/<a href="\/(vente|location)\/(.*?).html/is', $response, $out);
             $type = ($this->typecategoryid == 1) ? 'vente' : 'location';
                foreach($out[2] as $key=>$row){
                    $url = 'https://www.avendrealouer.fr/'.$type.'/'.$row.'.html';
                    $checkpage = Property::where('scrapurl',$url)->first('id');
                    if(empty($checkpage)){
                       $job = (new SaveProperty($url));
                       dispatch($job)->delay(now()->addMinutes(1));
                    } 
                }
         
         
    }
}

