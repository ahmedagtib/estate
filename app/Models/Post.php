<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\Category;


class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
     'id',   
     'title',
     'slug',
     'excerpt',
     'photo',
     'content',
     'meta_title',
     'meta_keyword',
     'meta_description',
     'statue',
  ];

  public $timestamps = true;
   
  public function tags(){
    return $this->belongsToMany(Tag::class,'tags_posts');
  }

  public  function category(){
      return $this->belongsTo(Category::class);
   }

}
