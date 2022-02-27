<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\theme;

class Login extends Component
{

    public $email;
    public $password;
    public $error;

    protected $rules = [
        'email'    => 'required|email',
        'password' => 'required',
    ];

    public function login(){
        $this->validate();

        if(Auth::attempt(['email'=>$this->email,'password'=>$this->password])){

            return redirect()->route('profile');
        }else{
            $this->error = __('lang.faildauthenticate');
        }


         
    }

    public function render()
    {
        $theme  = theme::first(['gmail','facebook']);
        return view('livewire.auth.login',['theme'=>$theme]);
    }
}
