<?php

namespace App\Http\Livewire\Admin;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use App\Models\Category;

class ManageCategory extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $allcategory = [];
    public $idcategory;
    public $category;
    public $button = false;


    public function clear(){
        $this->button = !$this->button;
        $this->idcategory     = '';
        $this->category       = '';

     }

    public function save(){
        $this->validate([
            'category' => 'required||unique:categories'
         ],[],[
           'category' => __('lang.category')  
         ]);
        
         Category::create([
            'category' => $this->category,
            'slug'     => Str::slug($this->category, '-')
         ]);
         session()->flash('message',__('lang.craetecategory',['category'=>$this->category]));
         return redirect()->route('category');

    }
    public function delete($id){
        $cat = Category::find($id);
        if($cat->has('posts')){
          foreach($cat->posts as $post){
            if(!empty($post->photo)){
               File::delete(public_path('/').$post->photo);               
            }
          }
        }
        
        $cat->delete();
        session()->flash('message',__('lang.categorydelete'));
        return redirect()->route('category');
      }
  
      public function update(){
        $this->validate([
            'category' => 'required|unique:categories'
         ],[],[
            'category' => __('lang.category')  
         ]);
         Category::where('id',$this->idcategory)->update([
           'category' => $this->category,
           'slug'  => Str::slug($this->category, '-')
          ]);
          session()->flash('message',__('lang.categoryupdate',['category'=>$this->category]));
          return redirect()->route('category');
      } 
     
      public function edit($id){
           $this->button = !$this->button;
           if($this->button){
              $category  = Category::where('id',$id)->first();
              $this->category = $category->category;
              $this->idcategory = $category->id;
           }else{
              $this->idcategory     = '';
              $this->category       = '';
           }
  
      }
  

    public function render()
    {
        return view('livewire.admin.manage-category',['allcategories'=>Category::paginate(10)])->extends('layouts.app',[       
         'metatitle'          => config('app.name').' | '. __('lang.managecategories'),
         'metadescription'    => config('app.name').' | '. __('lang.managecategories'),
         'metakeyword'        => __('lang.managecategories')
     ]);
    }
}
