<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\User;
class Property extends Model
{
    use HasFactory;
   

    protected $fillable = [
        'title',
        'slug',
        'propertytype',
        'status',
        'price',
        'energy',
        'ges',
        'area',
        'zipcode',
        'address',
        'description',
        'buildon',
        'bedrooms',
        'bathrooms',
        'rooms',
        'features',
        'photos',
        'thumbnails',
        'metatitle',
        'metadescription',
        'metakeyword',
        'name',
        'email',
        'phone',
        'poststatus',
        'scrapurl',
        'city_id',
        'user_id',
        'body',
        'created_at'
    ];
    public $timestamps = true;

    /*
    public function getPhotosAttribute($value){
          return explode(',',$value);
     }

     
     


    

     public function getThumbnailsAttribute($value){
          return explode(',',$value);
     }
  
     */



     

    public function getFeaturesAttribute($value){
        return json_decode($value,true);
    } 

    public function scopeSelection($query)
    {
        return $query->select('title','area','slug', 'propertytype', 'price', 'bedrooms', 'bathrooms', 'rooms','thumbnails','status');
    }

    public function scopeList($query)
    {
        return $query->select('address','city_id','title','area','slug', 'propertytype', 'price', 'bedrooms', 'bathrooms', 'rooms','thumbnails');
    }


     public function city()
     {
         return $this->belongsTo(City::class);
     }


     public function user()
     {
         return $this->belongsTo(User::class,'user_id');
     }
     

 

}
