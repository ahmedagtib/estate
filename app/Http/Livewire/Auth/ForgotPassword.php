<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use  App\Mail\Forogetpassword;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Mail;

class ForgotPassword extends Component
{
    public $email;
    public $success_forgot_message = null;
    public $error_forgot_message = null;
    protected $rules = ['email' => 'required|email'];

    public function sendmail(){

        $this->validate();
        $user = User::where('email',$this->email)->first();
        if($user){
            $token = app('auth.password.broker')->createToken($user);
             DB::table('password_resets')->insert([
                   'email'       =>$user->email,
                   'token'      =>$token,
                   'created_at' =>Carbon::now()
            ]);

            
            $data = ['token'=>$token,'name'=> $user->fullname];
            
             try {
              Mail::to($user->email)->send(new Forogetpassword($data));
            
             } catch (\Exception $e) {
                session()->flash('error',__('lang.waswrong'));
                return redirect()->route('home'); 
             }
           
            
          
             
     
            
            return $this->success_forgot_message = __('lang.success_forgot_message');
        } 
        
        return $this->error_forgot_message = __('lang.error_forgot_message');
    }

    public function render()
    {
        return view('livewire.auth.forgot-password')->extends('layouts.app',[       
            'metatitle'          => config('app.name').' | '. __('lang.forgot_password'),
            'metadescription'    => config('app.name').' | '. __('lang.forgot_password'),
            'metakeyword'        => __('lang.forgot_password')
      ]);
    }
}
