<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use App\Models\Tag;


class ManageTag extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
   //public $alltag = [];
    public $idtag;
    public $tag;
    public $button = false;


    public function clear(){
        $this->button    = !$this->button;
        $this->idtag     = '';
        $this->tag       = '';

     }

    public function save(){
        $this->validate([
            'tag' => 'required|unique:tags'
         ],[],[
           'tag' => __('lang.tag')  
         ]);
        
         Tag::create([
            'tag'      => $this->tag,
            'slug'     => Str::slug($this->tag, '-')
         ]);
         session()->flash('message',__('lang.createtag',['tag'=>$this->tag]));
         return redirect()->route('tag');

    }
    public function delete($id){
        $tag = Tag::find($id);
        $tag->delete();
        session()->flash('message',__('lang.tagdelete'));
        return redirect()->route('tag');
      }
  
      public function update(){
        $this->validate([
            'tag' => 'required||unique:tags'
         ],[],[
            'tag' => __('lang.tag')  
         ]);
         Tag::where('id',$this->idtag)->update([
           'tag' => $this->tag,
           'slug'  => Str::slug($this->tag, '-')
          ]);
          session()->flash('message',__('lang.tagupdate',['tag'=>$this->tag]));
          return redirect()->route('tag');
      } 
     
      public function edit($id){
           $this->button = !$this->button;
           if($this->button){
              $tag  = Tag::where('id',$id)->first();
              $this->tag = $tag->tag;
              $this->idtag = $tag->id;
           }else{
              $this->idtag     = '';
              $this->tag       = '';
           }
  
      }
  
    public function render()
    {
        return view('livewire.admin.manage-tag',['alltag'=>Tag::paginate(10)])->extends('layouts.app',[       
         'metatitle'          => config('app.name').' | '. __('lang.managetags'),
         'metadescription'    => config('app.name').' | '. __('lang.managetags'),
         'metakeyword'        => __('lang.managetags')
     ]);
    }
}
