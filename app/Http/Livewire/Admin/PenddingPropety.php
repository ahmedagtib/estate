<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Property;
use App\Jobs\SendNetfication;
use App\Models\NotificationToken;
class PenddingPropety extends Component
{

    public $array = [];

    public function change(){
        $this->validate([
            'array' => 'required'
        ],[
           
        ],[
            'array'=> __('lang.accepted')
        ]);

        foreach($this->array as $id){
            $prop = Property::where('id',$id)->update([
                'poststatus' => 'published'
            ]);
            
           NotificationToken::chunk(200, function ($tokens) use ($id) {
                foreach ($tokens as $token) {
                     dispatch(new SendNetfication($id,$token));
                }
            });
                        
           
        }
        session()->flash('message',__('lang.propertiespublished'));
        return redirect()->route('pending.property');
    }

    public function render()
    {

        $properties = Property::select('id','title','slug')->where('poststatus','pending')->paginate(10);
        return view('livewire.admin.pendding-propety',['properties'=>$properties])->extends('layouts.app',[       
            'metatitle'          => config('app.name').' | '. __('lang.pendingpropetites'),
            'metadescription'    => config('app.name').' | '. __('lang.pendingpropetites'),
            'metakeyword'        => __('lang.pendingpropetites')
        ]);
    }
}
