<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','gmail','facebook','property_view','landing_page'
    ];

    public $timestamps = true;
}
