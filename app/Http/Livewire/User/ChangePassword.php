<?php

namespace App\Http\Livewire\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ChangePassword extends Component
{
    public  $oldpassword;
    public  $password;
    public  $password_confirmation;

    public function save(){
        $this->validate([
             'oldpassword' => 'nullable',
             'password' => 'required|confirmed|min:6'
        ],[],[
            'oldpassword' => __('lang.cololdpassword'),
             'password' => __('lang.newpassword')
        ]);
        if(empty($this->oldpassword)){
            $this->oldpassword = 123456;
        }

        if(!Hash::check($this->oldpassword,Auth::user()->password)) { 
            session()->flash('error',__('lang.oldpasswordinccorect'));
            return redirect()->route('update.password');
        }else{
            User::where('id',Auth::user()->id)
            ->update(['password'=>bcrypt($this->password)]);
            session()->flash('message',__('lang.passwordchanged'));
            return redirect()->route('update.password');
        }
    }

    public function render()
    {
        return view('livewire.user.change-password')->extends('layouts.app',[       
            'metatitle'          => config('app.name').' | '. __('lang.updatepassword'),
            'metadescription'    => config('app.name').' | '. __('lang.updatepassword'),
            'metakeyword'        => __('lang.updatepassword')
    ]);
    }
}
