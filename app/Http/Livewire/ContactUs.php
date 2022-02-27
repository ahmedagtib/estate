<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Setting;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;

class ContactUs extends Component
{
    public $name;
    public $email;
    public $subject;
    public $message;
    public $myemail;

    public function mount(){
          $data =  Setting::first('email');
          $this->myemail = isset($data->email) ? $data->email : '';
    }

    public function  sendmail(){
        $data  = $this->validate([
            'name'      => 'required|min:5',
            'email'     => 'required|email',
            'subject'   => 'required|min:5',
            'message'   => 'required|min:10'
          ],[],[
            'name'      => __('lang.fullname'),  
            'email'     => __('lang.email'),  
            'subject'   => __('lang.subject'),  
            'message'   => __('lang.message')
         ]);


         if($this->myemail){
            Mail::to($this->myemail)->send(new Contact($data));
            session()->flash('message',__('lang.messagesent'));
            return redirect()->route('contactus');
         }else{
            session()->flash('error',__('lang.samthingwaswrong'));
            return redirect()->route('contactus');
         }
        
    }
    public function render()
    {
        $settingcontact = Setting::first(['contact_title','contact_content','adress','email','phone']);

        $contact_content = isset($settingcontact->contact_content) ? $settingcontact->contact_content : Config('helper.metadescription');
        return view('livewire.contact-us',[
                    'settingcontact'=>$settingcontact,
                    'metatitle'    => __('lang.contactus') .' | '.config('app.name'),
                    'metadescription'=> $contact_content,
                    'metakeyword'   => __('lang.contactus')
                    ])->extends('layouts.app');
    }
}
