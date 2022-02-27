<?php

namespace App\Http\Livewire\Admin;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use App\Models\City;
use App\Models\State;

use Livewire\Component;

class CityManage extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
     public $allstates = [];
     public $state_id;
     public $city;
     public $idcity;
     public $button = false;

     public function clear(){
      $this->button = !$this->button;
      $this->idcity     = '';
      $this->city       = '';
      $this->state_id   = -1;
   }

     public function delete($id){
        $city = City::find($id);
        $city->delete();
        session()->flash('message',__('lang.citydelete'));
        return redirect()->route('city');
      }
  
      public function update(){
        $this->validate([
            'city' => 'required|unique:cities'
         ],[],[
           'city' => __('lang.city')  
         ]);
          City::where('id',$this->idcity)->update([
           'city'    => $this->city,
           'slug'     => Str::slug($this->city, '-'),
           'state_id' => $this->state_id
          ]);
          session()->flash('message',__('lang.cityupdate',['city'=>$this->city]));
          return redirect()->route('city');
      } 
     
      public function edit($id){
           $this->button = !$this->button;
           if($this->button){
              $city = City::where('id',$id)->first();
              $this->city = $city->city;
              $this->idcity = $city->id;
              $this->state_id = $city->state_id;
           }else{
              $this->idcity     = '';
              $this->city       = '';
              $this->state_id = -1;
           }
  
      }
  
      public function  save(){
           $this->validate([
              'state_id' => 'required|exists:states,id',
              'city'     => 'required|unique:cities'
           ],[],[
              'state_id'  => __('lang.state'), 
              'city'      => __('lang.city')  
           ]);
           City::create([
              'city'      => $this->city,
              'slug'      => Str::slug($this->city, '-'),
              'state_id'  => $this->state_id
           ]);
  
           session()->flash('message',__('lang.citycreated',['city'=>$this->city]));
           return redirect()->route('city');
      }
      public function mount(){

         $this->allstates = State::all();
      } 

      public function render()
      {
         return view('livewire.admin.city',['allcity'=>City::paginate(10)])->extends('layouts.app',[       
            'metatitle'          => config('app.name').' | '. __('lang.managecities'),
            'metadescription'    => config('app.name').' | '. __('lang.managecities'),
            'metakeyword'        => __('lang.managecities')
        ]);
      }
}
