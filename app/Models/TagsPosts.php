<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagsPosts extends Model
{
    use HasFactory;

    protected $fillable = ['id','tag_id','post_id'];
    public $timestamps = true;
}
