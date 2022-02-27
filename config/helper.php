<?php



return [

'firebase_key'    => env('SERVER_API_KEY_FIREBASE',''), 
'firebase_apiKey'    => env('API_KEY_FIREBASE',''), 
'firebase_authDomain'    => env('AUTH_DOMIN_FIREBASE',''), 
'firebase_projectId'    => env('PROJECT_ID_FIREBASE',''), 
'firebase_storageBucket'    => env('STORAGE_BUCKET_FIREBASE',''), 
'firebase_messagingSenderId'    => env('MESSAGING_SENDER_ID_FIREBASE',''), 
'firebase_appId'    => env('APP_ID_FIREBASE',''),
'firebase_vapidKey'    => env('VAPID_KEY_FIREBASE',''),







'coin'            => '€',
'metadescription' => Config('app.name').'ae is the largest real estate website in the UAE with a wide range of residential and commercial properties for sale and for rent',
'metatitle'       => Config('app.name'), 
'metakeyword'     => Config('app.name'),
'author'          => Config('app.name')

];

?>