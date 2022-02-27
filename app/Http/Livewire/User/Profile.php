<?php

namespace App\Http\Livewire\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;


class Profile extends Component
{
  use WithFileUploads;
    public $fullname;
    public $email;
    public $title;
    public $phone;
    public $address;
    public $city;
    public $aboutyou;
    public $facebook;
    public $twitter;
    public $instagram;
    public $linkedin;
    public $photo;

    public function save()
    {

        $this->validate([
            'fullname'    => 'required|min:4',
            'photo'       => 'image|mimes:jpeg,jpg,png',
            'city'        => 'required',
            'aboutyou'    => 'required|min:10',
            'address'     => 'required|min:10',
            'title'       => 'required|min:5',
            'phone'       => 'required|regex:/(0)[0-9]{9}/',
        ]);
        

        $media = [
            "facebook"  => $this->facebook,
            "twitter"   => $this->twitter,
            "instagram" => $this->instagram,
            "linkedin"  => $this->linkedin
        ];

        if($this->photo) {
            if(Auth::user()->avatar){
                File::delete(public_path('/'). Auth::user()->avatar);
            }
            $filename =   time() . '-' .Str::slug($this->fullname, '_').'.jpg';
            $path = 'images/avatar/'.$filename;
            Image::make($this->photo)->resize(200,200)->save(public_path('/').$path);
            User::where('id',Auth::user()->id)->update(['avatar' => $path]);
        }

   
        User::where('id',Auth::user()->id)->update([
            'fullname'    => $this->fullname,
            'city'        => $this->city,
            'about'       => $this->aboutyou,
            'adresse'     => $this->address,
            'title'       => $this->title,
            'phone'       => $this->phone,
            'social_media'=> json_encode($media)
        ]);


        return redirect()->route('profile');
    }
     
    public function mount()
    {
       $user = Auth::user();
       $this->fullname = $user->fullname;
       $this->email    = $user->email;
       $this->city     = $user->city;
       $this->address  = $user->adresse;
       $this->title    = $user->title;
       $this->aboutyou = $user->about;
       $this->phone    = $user->phone;
       if(!empty($user->social_media)){
                $media = json_decode($user->social_media);
                $this->facebook  = $media->facebook; 
                $this->twitter   = $media->twitter; 
                $this->instagram = $media->instagram; 
                $this->linkedin  = $media->linkedin; 
       }

    }


    public function render()
    {
        return view('livewire.user.profile')->extends('layouts.app',[       
                'metatitle'          => config('app.name').' | '. __('lang.myprofile'),
                'metadescription'    => config('app.name').' | '. __('lang.myprofile'),
                'metakeyword'        => __('lang.myprofile')
        ]);
    }
}
