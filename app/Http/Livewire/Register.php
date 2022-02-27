<?php

namespace App\Http\Livewire;
use  App\Mail\RegisterMail;
use Livewire\Component;
use App\Models\theme;
use  App\Models\User;
use  App\Models\RoleUser;
use Illuminate\Support\Str;
use Mail;

class Register extends Component
{
    public $fullname; 
    public $email; 
    public $phone;
    public $type = '';
    public $password;
    public $password_confirmation;


    public function render()
    {
        $theme  = theme::first(['gmail','facebook']);
        return view('livewire.auth.register',['theme'=>$theme]);
    }


    public function save(){

        $this->validate([
            'fullname' => 'required|min:6',
            'email'    => 'required|email|unique:users',
            'phone'    => 'required|regex:/(0)[0-9]{9}/',
            'type'     => 'required|in:particulier,professionnel',
            'password' => 'required|min:6',
            'password_confirmation'=> 'required|same:password'
        ],[],[

            'fullname' => __('lang.fullname'),
            'email'    => __('lang.email'),
            'phone'    => __('lang.phone'),
            'type'     => __('lang.type'),
            'password' => __('lang.password'),
            'password_confirmation'=> __('lang.password_confirmation')
        ]);
       $id = User::insertGetId([
            'fullname' => $this->fullname,
            'email'    => $this->email,
            'username' => Str::slug($this->fullname, '_').rand(1,100),
            'phone'    => $this->phone,
            'type'     => $this->type,
            'password' => bcrypt($this->password)
        ]);

        RoleUser::create([
            'user_id'=>$id,
            'role_id'=> 2
        ]);
        
        try {
             Mail::to($this->email)->send(new RegisterMail($this->fullname));
            
         } catch (\Exception $e) {
             session()->flash('warning',__('lang.accountcreatedwithoutemail'));
             return redirect()->route('home'); 
        }
        session()->flash('message',__('lang.accountcreated',['name'=>$this->fullname]));
        return redirect()->route('home');
    }
}
