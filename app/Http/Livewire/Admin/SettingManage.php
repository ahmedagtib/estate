<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Setting;

class SettingManage extends Component
{
    use WithFileUploads;
    public $ids;
    /* home tab */
     public $button_search_form;
     public $hero_title;
     public $hero_content;
    /* footer tab */
    public $footer_title;
    public $footer_content;
    public $andriod_app;
    public $follow_title;

    /* contact tab */
    public $email;
    public $phone;
    public $adress;
    public $website;
    public $contact_title;
    public $contact_content;

    /* web tab */
     public $logo;
     public $media;
     public $facebook;
     public $instagram;
     public $twitter;
     public $linkedin;

    /* seo tab */
    public $meta_title;
    public $meta_description;
    public $meta_keyword;

    public function mount(){
       $setting    = Setting::first();
       if(isset($setting)){
            $this->ids  = $setting->id; 
            $this->button_search_form  =  $setting->button_search_form;
            $this->hero_title          =  $setting->hero_title;
            $this->hero_content        =  $setting->hero_content;
            $this->footer_title        =  $setting->footer_title; 
            $this->footer_content      =  $setting->footer_content;
            $this->andriod_app         =  $setting->andriod_app;
            $this->follow_title        =  $setting->follow_title;
            $this->email               =  $setting->email;
            $this->phone               =  $setting->phone;
            $this->adress              =  $setting->adress;
            $this->website             =  $setting->website;
            $this->contact_title       =  $setting->contact_title;
            $this->contact_content     =  $setting->contact_content;
           // $this->currency            =  $setting->currency;
            $array = $setting->media;

       $this->facebook           = (isset($array['facebook']))  ? $array['facebook'] : '';
       $this->instagram          = (isset($array['instagram'])) ? $array['instagram'] : '';  
       $this->twitter            = (isset($array['twitter']))   ? $array['twitter']: '';  
       $this->linkedin           = (isset($array['linkedin']))  ? $array['linkedin'] : ''; 
       $this->meta_title         = $setting->meta_title;
       $this->meta_description   = $setting->meta_description;
       $this->meta_keyword       = $setting->meta_keyword;   
    }
      
    }
    public function savehome(){
        $this->validate([
             'button_search_form'  => 'required',
             'hero_title'          => 'required',
             'hero_content'        => 'required'   

        ],[],[
            'button_search_form'=> __('lang.homebuttonsearch'),
            'hero_title'        => __('lang.herotitle'),
            'hero_content'      => __('lang.herocontent')
        ]);

        Setting::where('id',$this->ids)->update([
            'button_search_form'  => $this->button_search_form,
            'hero_title'          => $this->hero_title,
            'hero_content'        => $this->hero_content  
        ]);
      
        session()->flash('message',__('lang.settingupdated'));

        return redirect()->route('setting.manage');
    }
    
    public function savefooter(){
        $this->validate([
            'footer_title'             => 'required',
            'footer_content'           => 'required',
            'andriod_app'              => 'required',   
            'follow_title'             => 'required'

       ],[],[
           'footer_title'           => __('lang.footertitle'),
           'footer_content'         => __('lang.footercontent'),
           'andriod_app'            => __('lang.andriodapp'),
           'follow_title'           => __('lang.fallowtitle')
       ]);

       Setting::where('id',$this->ids)->update([
           'footer_title'        => $this->footer_title,
           'footer_content'      => $this->footer_content,
           'andriod_app'         => $this->andriod_app, 
           'follow_title'        => $this->follow_title  
       ]);
     
       session()->flash('message',__('lang.settingupdated'));

       return redirect()->route('setting.manage');
    }
    
    public function savecontact(){
        $this->validate([
            'email'                     => 'required|email',
            'phone'                     => 'required|regex:/(0)[0-9]{9}/',
            'adress'                    => 'required',   
            'website'                   => 'required',
            'contact_title'             => 'required',
            'contact_content'           => 'required'

       ],[],[
           'email'                  => __('lang.email'),
           'phone'                  => __('lang.phone'),
           'adress'                 => __('lang.address'),
           'website'                => __('lang.website'),
           'contact_title'          => __('lang.contact_title'),
           'contact_content'        => __('lang.contact_content')
       ]);

       Setting::where('id',$this->ids)->update([
            'email'              => $this->email,
            'phone'              => $this->phone,
            'adress'             => $this->adress,
            'website'            => $this->website,
            'contact_title'      => $this->contact_title,
            'contact_content'    => $this->contact_content
       ]);
     
       session()->flash('message',__('lang.settingupdated'));

       return redirect()->route('setting.manage');
    }
    
    public function savewebsite(){
        $this->validate([
             'logo'                => 'nullable|image',
             'facebook'            => 'nullable',
             'instagram'           => 'nullable',
             'twitter'             => 'nullable',  
             'linkedin'            => 'nullable', 
           

        ],[],[
            'logo'              => __('lang.logo'),
            'facebook'          => __('lang.facebook'),
            'instagram'         => __('lang.instagram'),
            'twitter'           => __('lang.twitter'),
            'linkedin'          => __('lang.linkedin'),
          
        ]);
        if($this->logo) {
            $path = '/images/logo/logo.png';
            Image::make($this->logo)->resize(180,44)->save(public_path().$path);
            Setting::where('id',$this->ids)->update(['logo'=> $path]);
        }
        $this->media = [
            'facebook'    => $this->facebook,
            'instagram'   => $this->instagram,
            'twitter'     => $this->twitter,
            'linkedin'    => $this->linkedin
        ];
        Setting::where('id',$this->ids)->update([
            'media'    => json_encode($this->media),

        ]);
      
        session()->flash('message',__('lang.settingupdated'));

        return redirect()->route('setting.manage');
    }

    public function saveseo(){
        


        $this->validate([
            'meta_title'                => 'required',
            'meta_description'          => 'required',
            'meta_keyword'              => 'required'   

       ],[],[
           'meta_title'        => __('lang.metatitle'),
           'meta_description'  => __('lang.metacontent'),
           'meta_keyword'      => __('lang.metakeyword')
       ]);

       Setting::where('id',$this->ids)->update([
           'meta_title'          => $this->meta_title,
           'meta_description'    => $this->meta_description,
           'meta_keyword'        => $this->meta_keyword  
       ]);
     
       session()->flash('message',__('lang.settingupdated'));

       return redirect()->route('setting.manage');
    }

    public function render()
    {
        return view('livewire.admin.setting-manage')->extends('layouts.app',[       
            'metatitle'          => config('app.name').' | '. __('lang.managestate'),
            'metadescription'    => config('app.name').' | '. __('lang.managestate'),
            'metakeyword'        => __('lang.managestate')
        ]);
    }
}
