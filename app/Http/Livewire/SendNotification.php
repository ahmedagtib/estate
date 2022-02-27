<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SendNotification extends Component
{
    public function render()
    {
        return view('livewire.send-notification')->extends('layouts.app',[       
            'metatitle'          => config('app.name').' | '. __('lang.findbylocation'),
            'metadescription'    => config('app.name').' | '. __('lang.findbylocation'),
            'metakeyword'        => __('lang.findbylocation')
        ]);
    }
}
