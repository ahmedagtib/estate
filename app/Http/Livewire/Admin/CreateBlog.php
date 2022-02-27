<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\TagsPosts;

class CreateBlog extends Component
{
    use WithFileUploads;
    public $title;
    public $photo;
    public $content;
    public $excerpt;
    public $meta_title;
    public $meta_keyword;
    public $meta_description;
    public $statue = 'publiched';
    public $category_id;
    public $tag;
    public $categories = [];


    public function mount(){
        $this->categories = Category::all();
        if(isset($this->categories[0]->id)){
            $this->category_id = $this->categories[0]->id;
        }
    }

    public function save(){

        $this->validate([
           'title'               => 'required|unique:posts',
           'content'             => 'required|min:20',
           'photo'               => 'required|image|mimes:jpeg,jpg,png',
           'meta_title'          => 'required',
           'meta_description'    => 'required',
           'meta_keyword'         => 'required',
           'statue'              => 'required|in:publiched,pending',
           'category_id'         => 'required|exists:categories,id'

        ],[],[
            'title'              => __('lang.titleblog'), 
            'content'            => __('lang.blogcontent'), 
            'photo'              => __('lang.photo'),   
            'meta_title'         => __('lang.metatitle'), 
            'meta_description'   => __('lang.metacontent'),  
            'meta_keyword'        => __('lang.metakeyword'), 
            'statue'             => __('lang.statue'),
            'category_id'        =>  __('lang.category') 
        ]);

        if($this->photo) {
            $filename =   time() . '-' .Str::slug($this->title, '-').'.jpg';
            $path = '/images/blogs/'.$filename;
            Image::make($this->photo)->resize(500,500)->save(public_path().$path);
        }

        $idpost = Post::insertGetId([
            'title'            => $this->title,
            'slug'             => Str::slug($this->title, '-'),
            'excerpt'          => (!empty($this->excerpt)) ? $this->excerpt : Str::limit(strip_tags($this->content),20),
            'content'          => $this->content,
            'photo'            => $path,
            'meta_title'       => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keyword'     => $this->meta_keyword,
            'statue'           => $this->statue,
            'category_id'      => $this->category_id
        ]);

        if(!empty($this->tag)){
            $tags = explode(",",$this->tag);
            foreach($tags as $t){
                
               $checktag = Tag::where('tag','like','%'.$t.'%')->first(); 
               if($checktag){
                 TagsPosts::create([
                    'tag_id'  => $checktag->id,
                    'post_id' => $idpost
                    ]);
               }else{
                 $tagid = Tag::insertGetId([
                    'tag' => $t,
                    'slug'=> Str::slug($t, '-')
                    ]);
                    $checktagpost =  TagsPosts::where('tag_id','like','%'.$tagid.'%')
                                          ->where('post_id','like','%'.$idpost.'%')
                                          ->first(); 
                    if(!$checktagpost){
                        TagsPosts::create([
                            'tag_id'  => $tagid,
                            'post_id' => $idpost
                        ]);
                    }                      

               }

            }
        }

        session()->flash('message',__('lang.blogcreated'));
        return redirect()->route('blog.manage');
    }
    public function render()
    {
        return view('livewire.admin.create-blog',['categories'=>$this->categories])->extends('layouts.app',[       
            'metatitle'          => config('app.name').' | '. __('lang.createblog'),
            'metadescription'    => config('app.name').' | '. __('lang.createblog'),
            'metakeyword'        => __('lang.createblog')
        ]);
    }
}
