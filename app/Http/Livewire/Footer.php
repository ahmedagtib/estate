<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Setting;
use App\Models\Page;
use App\Models\Newsletter;

class Footer extends Component
{
    public $email;
    public $msg;


   public function save(){
    $this->validate([
         'email'=> 'required|email|unique:newsletters'
      ],[],[
       'email' => __('lang.email')
      ]);
      Newsletter::create([
        'email'=> $this->email
      ]);
      $this->email = '';
      $this->msg = __('lang.newsletter');
   }

    public function render()
    {
        $footer = Setting::first(['footer_title','footer_content','andriod_app','media','email','phone','adress','website']);
        $pages   = Page::select(['title','slug'])->take(5)->get();
        return view('livewire.footer',[
            'footer'=> $footer, 
            'pages'  => $pages 
        ]);
    }
}
