<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class Navbar extends Component
{
    public $logo;
    public function logout(){
         Auth::logout();
        return redirect('/');

    }

    public function mount(){
        $logo = Setting::first('logo');

        $this->logo = $logo->logo ?? '';
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}
