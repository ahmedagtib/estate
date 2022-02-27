<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;

class State extends Model
{
    use HasFactory;
    protected $fillable = ['id','state','slug'];
    public $timestamps = true;

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
