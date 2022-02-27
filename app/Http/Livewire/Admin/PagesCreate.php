<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use App\Models\Page;

class PagesCreate extends Component
{
    use WithFileUploads;
    public $title;
    public $image;
    public $excerpt;
    public $content;
    public $meta_title;
    public $meta_content;
    public $meta_keyword;
    protected $rules = [
        'title'          => 'required|min:6',
        'image'          => 'required|image|mimes:jpeg,jpg,png',
        'content'        => 'required|min:10',
        'meta_title'     => 'required',
        'meta_content'   => 'required',
        'meta_keyword'   => 'required'
    ];

    public function save(){
     

        $this->validate();

        if($this->image) {
            $filename =   time() . '-' .Str::slug($this->title, '_').'.jpg';
            $path = '/images/pages/'.$filename;
            Image::make($this->image)->resize(500,500)->save(public_path().$path);
        }
         
        Page::create([
            'title'           => $this->title,
            'excerpt'         => ($this->excerpt) ? $this->excerpt : Str::limit($this->excerpt,50), 
            'slug'            => Str::slug($this->title, '-'),
            'image'           => ($this->image) ? $path : '',
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
        return view('livewire.admin.pages-create')->extends('layouts.app',[       
            'metatitle'          => config('app.name').' | '. __('lang.createnewpage'),
            'metadescription'    => config('app.name').' | '. __('lang.createnewpage'),
            'metakeyword'        => __('lang.createnewpage')
        ]);
    }
}
