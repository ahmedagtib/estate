<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\State;
use App\Models\Property;
class City extends Model
{
    use HasFactory;
    protected $fillable = ['id','city','slug','state_id'];
    public $timestamps = true;

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
