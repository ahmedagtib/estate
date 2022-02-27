<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Property;

class ListProperty extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

   public  function removeProperty($slug){
    $this->idp = preg_replace('/[^0-9]/','',substr(strrchr($slug,"-"),1));
     $property = Property::where('id',$this->idp)->where('user_id',Auth::user()->id)->first();
     
     if($property) {
         if(!empty($property->photos)){
             $data = explode(',',$property->photos);
             foreach($data as $path){
                File::delete(public_path($path)); 
             }
         }
         if(!empty($property->thumbnails)){
            $data = explode(',',$property->thumbnails);
            foreach($data as $path){
               File::delete(public_path($path)); 
            }
        }
         session()->flash('message', __('lang.propertydeleted'));
         $property->delete();
         return redirect()->route('myproperty');
     }else{
        return redirect()->route('404');
     }
    
   }

    public function render()
    {
        $properties = Property::where('user_id',Auth::user()->id)->select('title','slug','address','price','thumbnails','poststatus')->paginate(10);
        foreach($properties as $p){
            $images = explode(',',$p->thumbnails);
            $image  = $images[0];
            $p->image = $image; 
        }
        return view('livewire.user.list-property',[
            'properties' => $properties
        ])->extends('layouts.app',[       
            'metatitle'          => config('app.name').' | '. __('lang.myproperty'),
            'metadescription'    => config('app.name').' | '. __('lang.myproperty'),
            'metakeyword'        => __('lang.myproperty')
         ]);
    }
}
