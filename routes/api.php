<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\UserController; 

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


use Illuminate\Support\Facades\Http;
use App\Models\NotificationToken;
use App\Models\Property;

//savetoken
Route::post('/save/token',[UserController::class,'savetoken'])->name('save.token');

Route::get('/get/token',function(){
      
         $idp = 93;
          $property = Property::select('title','metadescription','slug','thumbnails')->where('id',$idp)->first();
                      
             $title = $property->title;
             
              
             $body  = $property->metadescription;
             $photo = explode(",",$property->thumbnails);
         
             $icon  = asset($photo[0]) ?? asset('images/logo/logo.png') ;
             
             $click_action = route('property',['slug'=>$property->slug]);
          
             $token = "fnHbisdsNVBhc0FhP715LS:APA91bGtt0tzAfqDWZR4ygEHa3OmY3QCbVPwXwoTlQ_PscFJcV1NgdGtXXfutQXIB8p5mhI9LmQ5WLA8FdeGGokYPCGrBD74qgUlwvFXMwwRLFPpE97uiTcsFkeT1y_HEG1sec-RaNPF";
        
              $response = Http::withHeaders([
              'Authorization' => 'key='.Config('helper.firebase_key'),
              'Content-Type'  => 'application/json',
                 ])->post('https://fcm.googleapis.com/fcm/send',[
                   "to" => $token,
                    "notification" => [
                         "title" => $title,
                         "body" =>  $body,
                         "icon" => $icon,
                         "click_action"=> $click_action
                        ]
                    ]);
                    
     
      
                    
              if(isset($response['results'][0]['error']) == 'NotRegistered'){
                    NotificationToken::where('token', $token)->delete();
               }
               
        
        return $response;
        
});



/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
