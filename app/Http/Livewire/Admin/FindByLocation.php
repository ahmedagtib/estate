<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Setting;
class FindByLocation extends Component
{
    public $imagecdn;
    public $url;
    public $cityname;
    public $numberproperty;
    public $data = array();
    public $ids;
    public  function mount(){
        $array = Setting::select('id','find_by_locations')->first();
        $this->data = json_decode($array->find_by_locations); 
        $this->ids = $array->id;
    
    }

  

    public function clear(){
        Setting::where('id',$this->ids)->update([
            'find_by_locations'=> null
        ]);

        session()->flash('message',__('lang.findbylocationcremoved'));
        return redirect()->route('findbylocation');
    }

    public function save(){
        $this->validate([
            'imagecdn'            => ['required'],
            'url'                 => ['required'],
            'cityname'            => ['required'],
            'numberproperty'      => ['required','integer']
          ],[],[
            'imagecdn'         => __('lang.imagecdn'),
            'url'              => __('lang.url'),
            'cityname'         => __('lang.cityname'),
            'numberproperty'   => __('lang.numberproperty')
          ]);
        


        $i = count($this->data);
        
        $this->data[$i]['imagecdn'] = $this->imagecdn; 
        $this->data[$i]['url']      = $this->url; 
        $this->data[$i]['cityname'] = $this->cityname; 
        $this->data[$i]['numberproperty'] = $this->numberproperty; 

        
        Setting::where('id',$this->ids)->update([
            'find_by_locations'=> json_encode($this->data)
        ]);

      
        
        session()->flash('message',__('lang.findbylocationcreated'));
        return redirect()->route('findbylocation');
    }



    public function render()
    {
        $array = Setting::select('id','find_by_locations')->first();
        $allcdn = json_decode($array->find_by_locations,true); 

        return view('livewire.admin.find-by-location',['allcdn'=>$allcdn])->extends('layouts.app',[       
            'metatitle'          => config('app.name').' | '. __('lang.findbylocation'),
            'metadescription'    => config('app.name').' | '. __('lang.findbylocation'),
            'metakeyword'        => __('lang.findbylocation')
        ]);
    }
}
