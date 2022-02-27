<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;
use App\Models\Post;
class ManageBlog extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titleSearch;

    public function delete($id){
        $post = Post::where('id',$id)->first();
        if($post){
            if(!empty($post->photo)){
                File::delete(public_path('/').$post->photo);               
             }
             $post->delete();
             session()->flash('message',__('lang.postdelete'));
             return redirect()->route('blog.manage');
        }else{
            session()->flash('error',__('lang.postnoexist'));
            return redirect()->route('blog.manage');
        }
    }

    public function render()
    {
        if(!empty($this->titleSearch)){
            $data = Post::where('title','like','%'.$this->titleSearch.'%')->paginate(10);
        }else{
            $data = Post::paginate(10);
        }
        return view('livewire.admin.manage-blog',['posts'=>$data])->extends('layouts.app',[       
            'metatitle'          => config('app.name').' | '. __('lang.blogmanage'),
            'metadescription'    => config('app.name').' | '. __('lang.blogmanage'),
            'metakeyword'        => __('lang.blogmanage')
        ]);
    }
}
