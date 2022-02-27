<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;
use App\Models\Property;
use App\Mail\MessageProperty;
use Illuminate\Support\Facades\Mail;

class MailProperty extends Component
{
    public $prop;
    public $show = false;
    public $phone;
    public $emailprop;
    public $nameprop;
    public $titleprop;
    public $slugprop;

    protected $listeners = ['show','send'];

    public $email;
    public $phoneclient;
    public $messageproperty;


    public function mount($idprop){
        $this->prop = Property::where('id',$idprop)->first(['id','user_id','slug','title','phone','email','name']);
        $this->phone = $this->prop->phone;
        $this->emailprop = $this->prop->email;
        $this->nameprop  = $this->prop->name;
        $this->titleprop  = $this->prop->title;
        $this->slugprop  = $this->prop->slug;

        

        $this->messageproperty = __('lang.messageproperty');
  
    }

    public function send()
    {
        
        $data = $this->validate([
            'email'  => 'required|email',
            'phoneclient'=> 'required|regex:/(0)[0-9]{9}/',
            'messageproperty' => 'required|min:6'
        ],[],[
            'email'            => __('lang.email'),
            'phoneclient'      => __('lang.phone'),
            'messageproperty'  => __('lang.message'),
        ]);
   
  
       
             try {
               Mail::to($this->emailprop)->send(new MessageProperty($data,$this->nameprop,$this->titleprop));
             }catch(\Exception $e) {
               session()->flash('error',__('lang.waswrong'));
               return redirect()->route('property',$this->slugprop);
             }
           
            

      session()->flash('message',__('lang.messagesent'));
         $this->email = '';
         $this->phoneclient = '';
         $this->messageproperty = __('lang.messageproperty');

         return redirect()->route('property',$this->slugprop);
        
    }

    public function render()
    {
        
        return view('livewire.component.mail-property');
    }
}
