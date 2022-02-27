<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\theme;

class ThemeCustom extends Component
{

     public $gmail = 0;
     public $facebook = 0;
     public $propertypage;
     public $homepage;
     public $idtheme;


     public function send(){
        theme::where('id',$this->idtheme)->update([
            'gmail'        => $this->gmail,
            'facebook'     => $this->facebook,
            'property_view'     => $this->propertypage,
            'landing_page'     => $this->homepage
        ]);

        session()->flash('message',__('lang.themeupdated'));
        return redirect()->route('theme');
     }

     public function mount(){

        $theme = theme::first();
        $this->idtheme = $theme->id;
        if($theme->gmail){$this->gmail = 1;}
         if($theme->facebook){$this->facebook = 1;}

        $this->propertypage = $theme->property_view;
        $this->homepage  = $theme->landing_page;

     }

    public function render()
    {
        
        return view('livewire.admin.theme-custom')->extends('layouts.app',[       
            'metatitle'          => config('app.name').' | '. __('lang.customtheme'),
            'metadescription'    => config('app.name').' | '. __('lang.customtheme'),
            'metakeyword'        => __('lang.customtheme')
        ]);;
    }
}
