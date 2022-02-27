<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use App\Models\State;

class StateManage extends Component
{
   use WithPagination;
   protected $paginationTheme = 'bootstrap';
    public $state;
    public $idstate;
    public $button = false;

    public function clear(){
       $this->button = !$this->button;
        $this->idstate     = '';
        $this->state       = '';
    }
    public function delete($id){
      $state = State::find($id);
      $state->delete();
      session()->flash('message',__('lang.statedelete'));
      return redirect()->route('state');
    }

    public function update(){
      $this->validate([
          'state' => 'required|unique:states'
       ],[],[
         'state' => __('lang.state')  
       ]);
        State::where('id',$this->idstate)->update([
         'state' => $this->state,
         'slug'  => Str::slug($this->state, '-')
        ]);
        session()->flash('message',__('lang.stateupdate',['state'=>$this->state]));
        return redirect()->route('state');
    } 
   
    public function edit($id){
         $this->button = !$this->button;
         if($this->button){
            $state = State::where('id',$id)->first();
            $this->state = $state->state;
            $this->idstate = $state->id;
         }else{
            $this->idstate     = '';
            $this->state       = '';
         }

    }

    public function  save(){
         $this->validate([
            'state' => 'required|unique:states'
         ],[],[
            'state' => __('lang.state')  
         ]);
         State::create([
            'state' => $this->state,
            'slug'  => Str::slug($this->state, '-')
         ]);

         session()->flash('message',__('lang.statecreated',['state'=>$this->state]));
         return redirect()->route('state');
    }




    public function render()
    {
        return view('livewire.admin.state',['allstate'=>State::paginate(15)])->extends('layouts.app',[       
         'metatitle'          => config('app.name').' | '. __('lang.setting'),
         'metadescription'    => config('app.name').' | '. __('lang.setting'),
         'metakeyword'        => __('lang.setting')
     ]);
    }
}
