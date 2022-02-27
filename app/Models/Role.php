<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name','created_at'];
    public $timestamps = true;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
