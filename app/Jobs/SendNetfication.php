<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Models\NotificationToken;
use App\Models\Property;

class SendNetfication implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public $idp;
    public $token;
    public $title;
    public $body;
    public $icon;
    public $click_action;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($idp,$token)
    {           $this->token   = $token['token'];   
                  $this->idp = $idp;
          $property = Property::select('title','metadescription','slug','thumbnails')
                      ->where('id',$idp)->first();
             $this->title = $property->title;
             $this->body  = $property->metadescription;
             $photo = explode(",",$property->thumbnails);
             $this->icon  = asset($photo[0]) ?? asset('images/logo/logo.png') ;
             $this->click_action = route('property',['slug'=>$property->slug]);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      
                
              $response = Http::withHeaders([
              'Authorization' => 'key='.Config('helper.firebase_key'),
              'Content-Type'  => 'application/json',
                 ])->post('https://fcm.googleapis.com/fcm/send',[
                   "to" => $this->token,
                    "notification" => [
                         "title" => $this->title,
                         "body" =>  $this->body,
                         "icon" => $this->icon,
                         "click_action"=> $this->click_action
                        ]
                    ]);
                    
              if(isset($response['results'][0]['error']) == 'NotRegistered'){
                    NotificationToken::where('token',$this->token)->delete();
               }
               
              
         
    }
}
