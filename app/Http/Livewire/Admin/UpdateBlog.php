<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\TagsPosts;

class UpdateBlog extends Component
{
    use WithFileUploads;
    public $idpost;
    public $title;
    public $photo;
    public $content;
    public $excerpt;
    public $meta_title;
    public $meta_keyword;
    public $meta_description;
    public $oldphoto;
    public $statue;
    public $tag;
    public $category_id;
    

    public function mount(Request $request){
        $post = Post::with('tags')->where('id',$request->id)->first();
        if(!empty($post)){
           $this->idpost  = $post->id;
           $this->category_id  = $post->category_id; 
           $this->title   = $post->title; 
           $this->excerpt = strip_tags($post->excerpt); 
           $this->content = $post->content;
           $this->meta_title = $post->meta_title;
           $this->meta_keyword = $post->meta_keyword;
           $this->meta_description = $post->meta_description;
           $this->oldphoto = $post->photo;
           $this->statue = $post->statue;
           foreach($post->tags as $t){
               $this->tag .=$t->tag.',';
           }
           //$post->tags
        }else{
            session()->flash('error',__('lang.postnoexist'));
           return redirect()->route('blog.manage');
        }
        //dd($request->id);
    }

    public function save(){
        $this->validate([
           'title'               => 'required',
           'content'             => 'required|min:20',
           'meta_title'          => 'required',
           'meta_description'    => 'required',
           'meta_keyword'         => 'required',
           'statue'              => 'required|in:publiched,pending',
           'category_id'         => 'required|exists:categories,id'

        ],[],[
            'title'              => __('lang.titleblog'), 
            'content'            => __('lang.blogcontent'), 
           
            'meta_title'         => __('lang.metatitle'), 
            'meta_description'   => __('lang.metacontent'),  
            'meta_keyword'        => __('lang.metakeyword'), 
            'statue'             => __('lang.statue'),
            'category_id'        =>  __('lang.category') 
        ]);

        if($this->photo) {
            $this->validate(['photo' => 'image|mimes:jpeg,jpg,png'],[],[
                'photo'              => __('lang.photo')
            ]);
            if(!empty($this->oldphoto)){
                File::delete(public_path('/').$this->oldphoto);               
            }
            $filename =   time() . '-' .Str::slug($this->title, '-').'.jpg';
            $path = '/images/blogs/'.$filename;
            Image::make($this->photo)->resize(500,500)->save(public_path().$path);
        }

        Post::where('id',$this->idpost)->update([
            'title'            => $this->title,
            'slug'             => Str::slug($this->title, '-'),
            'excerpt'          => (!empty($this->excerpt)) ? $this->excerpt : Str::limit($this->content,20),
            'content'          => $this->content,
            'photo'            => ($this->photo) ? $path : $this->oldphoto,
            'meta_title'       => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keyword'     => $this->meta_keyword,
            'statue'           => $this->statue,
            'category_id'      => $this->category_id
        ]);

        if(!empty($this->tag)){
            TagsPosts::where('post_id',$this->idpost)->delete();
            $tags = explode(",",$this->tag);
            foreach($tags as $t){
                
               $checktag = Tag::where('tag','like','%'.$t.'%')->first(); 
               if($checktag){
                 TagsPosts::create([
                    'tag_id'  => $checktag->id,
                    'post_id' => $this->idpost
                    ]);
               }else{
                 $tagid = Tag::insertGetId([
                    'tag' => $t,
                    'slug'=> Str::slug($t, '-')
                    ]);
                    $checktagpost =  TagsPosts::where('tag_id','like','%'.$tagid.'%')
                                          ->where('post_id','like','%'.$this->idpost.'%')
                                          ->first(); 
                    if(!$checktagpost){
                        TagsPosts::create([
                            'tag_id'  => $tagid,
                            'post_id' => $this->idpost
                        ]);
                    }                      

               }

            }
        }

        session()->flash('message',__('lang.blogupdated'));
        return redirect()->route('blog.manage');
    }





    public function render()
    {
        return view('livewire.admin.update-blog',['categories'=>Category::all()])->extends('layouts.app',[       
            'metatitle'          => config('app.name').' | '. __('lang.updateblog'),
            'metadescription'    => config('app.name').' | '. __('lang.updateblog'),
            'metakeyword'        => __('lang.updateblog')
        ]);
    }
}
