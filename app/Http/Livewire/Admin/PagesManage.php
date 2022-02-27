<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\File;
use App\Models\Page;



class PagesManage extends Component
{

    //File::delete(public_path('/').$this->oldimage); 
    public function delete($id){
       $page = Page::where('id',$id)->first();
       if($page){
            if(!empty($page->image)){
                File::delete(public_path('/').$page->image);               
            }
            $page->delete();
            session()->flash('message',__('lang.pagedelete'));
            return redirect()->route('page'); 
       } 
       session()->flash('error',__('lang.pagenotfound'));
       return redirect()->route('page'); 
    }
    public function render()
    {
        return view('livewire.admin.pages-manage',['allpages'=>Page::all()])->extends('layouts.app',[       
            'metatitle'          => config('app.name').' | '. __('lang.managepages'),
            'metadescription'    => config('app.name').' | '. __('lang.managepages'),
            'metakeyword'        => __('lang.managepages')
        ]);
    }
}
