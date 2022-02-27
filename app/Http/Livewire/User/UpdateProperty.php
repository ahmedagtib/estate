<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use App\Models\State;
use App\Models\City;
use App\Models\Property;
use Illuminate\Http\Request;
class UpdateProperty extends Component
{
    use WithFileUploads;
    public $current_step = 5;
    public $percentage = 100;
    public $allcities = [];
    public $stateId;
    public $allstate;
    public $city;
    public $photopaths = "";
    public $oldthumbnails = "";
    public $thumbnails;
    public $idp;
    public $oldphotos;
   
    /* prorprty  varibles */
    public $title;
    public $propertyType = 'apartment';
    public $status = 'rent';
    public $price;
    public $energy = 'c';
    public $ges = 'c';
    public $area;
    public $zipcode;
    public $address;
    public $description;
    public $buildon = "2010";
    public $bedrooms = null;
    public $bathrooms = null;
    public $rooms = null;
    public $garage = null;
    public $features = [];
    public $photos = [];
    public $name;
    public $email;
    public $phone;
    public $user_id = 0;
    public $city_id;


    public function removeMe($index)
    {
        array_splice($this->photos, $index, 1);
    }

    public function nextstep()
    {
        if ($this->current_step == 1)
        {
            $this->validate(['title' => 'required|min:5', 'city_id' => 'required|exists:cities,id', 'status' => 'required|in:rent,sale', 'price' => 'required|numeric', 'propertyType' => 'required|in:houses,apartment,villas,commercial,offices,garage,ground'], [], ['title' => __('lang.propertytype') , 'city_id' => __('lang.city') , 'status' => __('lang.city') , 'price' => __('lang.price') , 'propertyType' => __('lang.propertytype')

            ]);
        }
        if ($this->current_step == 2)
        {
            $this->validate(['energy' => 'required|in:a,b,c,d,e,f,g', 'ges' => 'sometimes|in:a,b,c,d,e,f,g', 'area' => 'required|numeric', 'zipcode' => 'required', 'address' => 'required',

            ], [], ['energy' => __('lang.energyclass') , 'ges' => __('lang.ges') , 'area' => __('lang.area') , 'zipcode' => __('lang.zipcode') , 'address' => __('lang.address') ,

            ]);

            if ($this->propertyType == 'ground')
            {
                $this->current_step++;
                $this->percentage += 20;

            }

        }

        if ($this->current_step == 3)
        {
            if ($this->propertyType != 'ground')
            {
                $this->validate(['buildon' => 'required|numeric'], [], ['buildon' => __('lang.buildon') ]);
                if ($this->propertyType == 'houses' || $this->propertyType == 'apartment' || $this->propertyType == 'villas')
                {
                    $this->validate(['bedrooms' => 'required|numeric|between:1,5', 'bathrooms' => 'required|numeric|between:1,5', 'rooms' => 'required|numeric|between:1,5', 'garage' => 'nullable|numeric|between:1,5',

                    ], [], ['bedrooms' => __('lang.bedrooms') , 'bedrooms' => __('lang.bedrooms') , 'rooms' => __('lang.rooms') , 'garage' => __('lang.garage') , ]);
                }

            }
        }

        if ($this->current_step == 4)
        {
            if(count($this->oldphotos) < 0){
                $this->validate(['photos' => 'required', 'photos.*' => 'required|image|mimes:jpeg,jpg,png'], [], ['photos.*' => __('lang.photos') , 'photos' => __('lang.photos') ]);
            }
           

        }

        $this->current_step++;
        $this->percentage += 20;
    }

    public function save()
    {
        if ($this->current_step == 5)
        {
            $this->validate(['description' => 'required', 'name' => 'required', 'email' => 'required|email', 'phone' => 'nullable|regex:/(0)[0-9]{9}/'], [], ['name' => __('lang.fullname') , 'email' => __('lang.email') , 'phone' => __('lang.phone') , 'description' => __('lang.description')

            ]);
        }


        //Property photo
        if (count($this->photos) > 0)
        {
            $nbcount = count($this->photos);
            $i = 0;
            foreach ($this->photos as  $photo)
            {
               
                $filename = $i . '-' . time() . '-' . Str::slug($this->title, '_') . '.jpg';
                $path = 'images/property/' . $filename;
                Image::make($photo)->resize(1280,850)
                    ->save(public_path('/') . $path);
                    
                    if(++$i == $nbcount){
                        $this->photopaths .= $path;
                    }else{
                        $this->photopaths .= $path.",";
                   }

            }

            foreach($this->oldthumbnails as $t){
                File::delete(public_path($t));
            }
             $i = 0;
            for($j = 0;$j < 2 ; $j++){
                $filename = $j . '-' . time() . '-' .Str::slug($this->title, '_').'.jpg';
                $path = 'images/property/thumbnail/' . $filename;
               if(isset($this->photos[$j])){
                Image::make($this->photos[$j])->resize(280,220)
                    ->save(public_path('/') . $path);
                    if(++$i === $nbcount) {
                        $this->thumbnails .= $path;
                    }else{
                        $this->thumbnails  .= $path.",";  
                   }
                }
              }
        }
        
        
        if (count($this->oldphotos) > 0){
            $nbcount = count($this->oldphotos);
            $i = 0;
            foreach ($this->oldphotos as  $path)
            {
                
                if(++$i == $nbcount) {
                    $this->photopaths .= $path;
                }else{
                    if(count($this->photos) > 0){
                        $this->photopaths .= ",".$path.",";
                    }else{
                        $this->photopaths .= $path.",";
                    }
                        
                    
                }
            }

        }
                
        
        $property = Property::where('id',$this->idp)
                              ->where('user_id',Auth::user()->id)
                              ->first();
        $property->title = $this->title;
        $property->slug = Str::slug($this->title, '-');
        $property->propertytype = $this->propertyType;
        $property->status = $this->status;
        $property->price = $this->price;
        $property->energy = $this->energy;
        $property->ges = $this->ges;
        $property->area = $this->area;
        $property->zipcode = $this->zipcode;
        $property->address = $this->address;
        $property->description = $this->description;
        $property->buildon = $this->buildon;
        $property->bedrooms = $this->bedrooms;
        $property->bathrooms = $this->bathrooms;
        $property->rooms = $this->rooms;
        $property->garage = $this->garage;
        $property->features = json_encode($this->features);
        $property->photos  = $this->photopaths;
        $property->name = $this->name;
        $property->email = $this->email;
        $property->phone = $this->phone;
        $property->poststatus = 'pending';
        $property->user_id = $this->user_id;
        $property->city_id = $this->city_id;
        if(!empty($this->thumbnails)){
            $property->thumbnails = $this->thumbnails;
        }
        $property->save();

        $property->slug = Str::slug($this->title . '-' . $property->id, '-');
        $property->update();

        session()
            ->flash('message', __('lang.propertycreated'));
        if ($this->user_id === 0)
        {

            return redirect()
                ->route('create.property');
        }
        else
        {
            return redirect()
                ->route('myproperty');
        }

    }

    public function prevstep()
    {
        if ($this->current_step == 4)
        {
            if ($this->propertyType == 'ground')
            {
                $this->current_step--;
                $this->percentage -= 20;
            }
        }
        $this->current_step--;
        $this->percentage -= 20;
    }

    public function mount(Request $request)
    {
       // dd($request->slug);
        if (Auth::check())
        {
        $this->user_id = Auth::user()->id;
        $this->allstate = State::all();
        $this->idp = preg_replace('/[^0-9]/','',substr(strrchr($request->slug,"-"),1));
        $property = Property::where('id',$this->idp)->where('user_id',$this->user_id)->first();
        if($property != null){
                 $this->haasPro = true;
                 $this->city = City::where('id', $property->city_id)->first();
                 $this->stateId = $this->city->state->id;
                 $this->updatedStateId($this->stateId,$this->city->id);
                 $this->title        = $property->title;
                 $this->propertyType = $property->propertytype;
                 $this->status       = $property->status;
                 $this->price        = $property->price;
                 $this->energy       = $property->energy;
                 $this->ges          = $property->ges;
                 $this->area         = $property->area;
                 $this->zipcode      = $property->zipcode;
                 $this->address      = $property->address; 
                 $this->description  = $property->description; 
                 $this->buildon      = $property->buildon; 
                 $this->bedrooms     = $property->bedrooms; 
                 $this->bathrooms    = $property->bathrooms; 
                 $this->rooms        = $property->rooms; 
                 $this->garage       = $property->garage; 
                 $this->features     = $property->features; 
                 $this->name         = $property->name; 
                 $this->email        = $property->email; 
                 $this->phone        = $property->phone; 
                 $this->oldphotos    = explode(',',$property->photos);
                 $this->oldthumbnails  = explode(',',$property->thumbnails);
                
            }else{
                return redirect()->route('404','404');
          }

        }
        

        
    }
  
    public function removePath($path){
         $result = File::exists(public_path($path));

         if(($key = array_search($path,$this->oldphotos)) !== false) {
            unset($this->oldphotos[$key]);
            File::delete(public_path($path)); 
            $property = Property::where('id',$this->idp)
            ->where('user_id',Auth::user()->id)
            ->first();
        
          $property->photos = '';
            //dd($property->photos);

            $count = count($this->oldphotos);
            $i = 0;
           
            foreach($this->oldphotos as $p){

               if(++$i == $count){
                $property->photos .= $p;   
               }else{
                $property->photos .= $p.",";
               }
            }
            $property->update();
            
          }


        
    }

    public function render()
    {

        return view('livewire.user.update-property')->extends('layouts.app',[       
            'metatitle'          => config('app.name').' | '. __('lang.update').' '.__('lang.property'),
            'metadescription'    => config('app.name').' | '. __('lang.update').' '.__('lang.property'),
            'metakeyword'        => __('lang.update').' '.__('lang.property')
    ]);
    }

    public function updatedStateId($stateId,$c = null)
    {
        $this->allcities = City::where('state_id', $stateId)->get();

        $this->city = City::where('state_id', $stateId)->select('id')
            ->first();
        if($c == null){
            if ($this->city)
            {
                $this->city_id = $this->city->id;
            }
            else
            {
                $this->city_id = '';
            }
        }else{
            $this->city_id = $c;
        }

    }
}
