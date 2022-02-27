<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = ['id',
                            'find_by_locations',
                            'button_search_form',
                            'hero_title',
                            'hero_content',
                            'media',
                            'footer_content',
                            'footer_title'
                        
                         ];
    public $timestamps = true;

    public function getMediaAttribute($value){
        return json_decode($value,true);
    } 







}
