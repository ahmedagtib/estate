<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use App\Models\Page;
use Illuminate\Http\Request;
class PagesUpdate extends Component
{
    
    use WithFileUploads;



    public $pageid;
    public $title;
    public $image;
    public $oldimage;
    public $excerpt;
    public $content;
    public $meta_title;
    public $meta_content;
    public $meta_keyword;
    protected $rules = [
        'title'          => 'required|min:6',
        'content'        => 'required|min:10',
        'meta_title'     => 'required',
        'meta_content'   => 'required',
        'meta_keyword'   => 'required'
    ];
    
    public function mount(Request $request){
        $page = Page::where('id',$request->id)->first();
        if($page){
            $this->pageid    =  $page->id;
            $this->title    =  $page->title;
            $this->oldimage =  $page->image;
            $this->excerpt  =  $page->excerpt;
            $this->content  =  $page->content;
            $this->meta_title = $page->meta_title;
            $this->meta_content = $page->meta_content;
            $this->meta_keyword = $page->meta_keyword;
        }else{

            session()->flash('error',__('lang.pagenotfound'));
             return redirect()->route('page');
        }
        
    }
    public function save(){
        $this->validate();
        if($this->image) {
            $this->validate(['image' => 'image|mimes:jpeg,jpg,png']);
            if(!empty($this->oldimage)){
                File::delete(public_path('/').$this->oldimage);               
            }
            $filename =   time() . '-' .Str::slug($this->title, '_').'.jpg';
            $path = '/images/pages/'.$filename;
            Image::make($this->image)->resize(500,500)->save(public_path().$path);
            Page::where('id',$this->pageid)->update(['image' => $path]);
        }
         
        Page::where('id',$this->pageid)->update([
            'title'           => $this->title,
            'excerpt'         => ($this->excerpt) ? $this->excerpt : Str::limit($this->excerpt,50), 
            'slug'            => Str::slug($this->title, '-'),
            'content'         => $this->content, 
            'meta_title'      => $this->meta_title, 
            'meta_content'    => $this->meta_content,
            'meta_keyword'    => $this->meta_keyword
        ]);

        session()->flash('message',__('lang.pagecreated'));
        return redirect()->route('page');
    }
    public function render()
    {
        
        return view('livewire.admin.pages-update')->extends('layouts.app',[       
            'metatitle'          => config('app.name').' | '. __('lang.updatepage'),
            'metadescription'    => config('app.name').' | '. __('lang.updatepage'),
            'metakeyword'        => __('lang.updatepage')
        ]);
    }
}
