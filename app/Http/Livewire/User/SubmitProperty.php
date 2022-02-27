<?php
namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use App\Models\State;
use App\Models\City;
use App\Models\Property;

class SubmitProperty extends Component
{
    use WithFileUploads;
    public $current_step = 1;
    public $percentage = 20;
    public $allcities = [];
    public $stateId;
    public $allstate;
    public $city;
    private $photopaths;
    private $thumbnails;
    /* prorprty  varibles */
    public $title;
    public $propertyType = 'apartment';
    public $status = 'rent';
    public $price;
    public $energy = 'virgin';
    public $ges = 'virgin';
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
            $this->validate(['title' => 'required|min:5', 'city_id' => 'required|exists:cities,id', 'status' => 'required|in:rent,sale', 'price' => 'required|numeric', 'propertyType' => 'required|in:houses,apartment,villas,commercial,offices,garage,ground'], [], ['title' => __('lang.propertytype') , 'city_id' => __('lang.city') , 'status' => __('lang.status') , 'price' => __('lang.price') , 'propertyType' => __('lang.propertytype')

            ]);
        }
        if ($this->current_step == 2)
        {
            $this->validate(['description' => 'required','energy' => 'sometimes|in:a,b,c,d,e,f,g,virgin', 'ges' => 'sometimes|in:a,b,c,d,e,f,g,virgin', 'area' => 'required|numeric', 'zipcode' => 'required', 'address' => 'required',

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
            $this->validate(['photos' => 'required', 'photos.*' => 'required|image|mimes:jpeg,jpg,png'], [], ['photos.*' => __('lang.photos') , 'photos' => __('lang.photos') ]);

        }

        $this->current_step++;
        $this->percentage += 20;
    }

    public function save()
    {
        if ($this->current_step == 5)
        {
            $this->validate(['name' => 'required','email' => 'required|email', 'phone' => 'nullable|regex:/(0)[0-9]{9}/'], [], ['name' => __('lang.fullname') , 'email' => __('lang.email') , 'phone' => __('lang.phone') , 'description' => __('lang.description')

            ]);
        }

        //Property photo
        
         
        if (count($this->photos) > 0)
        {
            $numItems = count($this->photos);
            $i = 0;
            foreach ($this->photos as  $photo)
            {
                $filename = $i . '-' . time() . '-' . Str::slug($this->title, '_') . '.jpg';
                $path = 'images/property/' . $filename;
                Image::make($photo)->resize(1280,850)
                    ->save(public_path('/') . $path);
                    if(++$i === $numItems) {
                        $this->photopaths .= $path;
                    }else{
                       $this->photopaths .= $path.",";
                   }
                      
            }
           
//dd($this->photos);
            for($j = 0;$j < 2 ; $j++){
                $filename = $j . '-' . time() . '-' .Str::slug($this->title, '_').'.jpg';
                $path = 'images/property/thumbnail/' . $filename;
               if(isset($this->photos[$j])){
                Image::make($this->photos[$j])->resize(280,220)
                    ->save(public_path('/') . $path);
                    if(++$i === $numItems) {
                        $this->thumbnails .= $path;
                    }else{
                        $this->thumbnails  .= $path.",";  
                   }
                }
              }
        }
   
       // dd(explode(",",$this->photopaths));
         $metatitle = '';
         $metadescription = '';
         $metakeyword = '';
         if($this->propertyType){
            if ($this->propertyType == 'apartment') {
               $metadescription .= __('lang.apartment');
               $metatitle       .= __('lang.apartment');
             }elseif($this->propertyType == 'houses'){
                $metadescription .= __('lang.houses');
                $metatitle       .= __('lang.houses');
             }elseif($this->propertyType == 'villas'){
                 $metadescription .= __('lang.villas');
                 $metatitle .= __('lang.villas');
             }elseif($this->propertyType == 'commercial'){
                $metadescription .= __('lang.commercial');
                $metatitle .= __('lang.commercial');
             }elseif($this->propertyType == 'offices'){
                $metadescription .= __('lang.offices');
                $metatitle .= __('lang.offices');
             }elseif($this->propertyType == 'garage'){ 
                 $metadescription .= __('lang.garage');
                 $metatitle .= __('lang.garage');
             }elseif($this->propertyType == 'ground'){ 
              $metadescription .= __('lang.ground');
              $metatitle .= __('lang.ground');
            }
         }

         if($this->status){
             if($this->status == 'rent'){
                $metadescription .= ' '.__('lang.forrent').' ';
                $metatitle .= ' '.__('lang.forrent').' ';
             }else{
               $metadescription .= ' '.__('lang.forsale').' ';
                $metatitle .= ' '.__('lang.forsale').' ';
             } 
         }

         if($this->rooms){
            $metadescription .=  __('lang.has').' '.$this->rooms .' '.__('lang.rooms').' ';
            $metatitle .=  __('lang.has').' '.$this->rooms .' '.__('lang.rooms').' ';
         }

         if($this->bedrooms){
            $metadescription .= ' '.__('lang.with').' '.$this->bedrooms.' '.__('lang.bedrooms');
         }

         if($this->bathrooms){
            $metadescription .= ' '. __('lang.and').' '.$this->bathrooms.' '.__('lang.bathrooms');
         }

         if($this->buildon){
            $metadescription .=  ' '.__('lang.buildon').' '.$this->buildon.' ';
         }
         
         if($this->city){
            $metadescription .= ' '.__('lang.in').' '.$this->city->city.' '.__('lang.city');
            $metatitle .=  ' '.__('lang.in').' '.$this->city->city.' '.__('lang.city');
         }

        if(count($this->features) > 0){
            $metakeyword = implode(",",$this->features);
        }
   

        $property = new Property();
        $property->title = $this->title;
        $property->metatitle = $metatitle;
        $property->metadescription = $metadescription;
        $property->metakeyword = $metakeyword;
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
        $property->photos = $this->photopaths;
        $property->thumbnails = $this->thumbnails;
        $property->name = $this->name;
        $property->email = $this->email;
        $property->phone = $this->phone;
        $property->poststatus = 'pending';
        $property->user_id = $this->user_id;
        $property->city_id = $this->city_id;
        //dd($property);
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

    public function mount()
    {
        $this->allstate = State::all();
        if(isset($this->allstate[0]->id)){
        $this->stateId = $this->allstate[0]->id;
        }
        $this->updatedStateId($this->stateId);
        $this->city = City::where('state_id', $this->stateId)
            ->select('id')
            ->first();
        if($this->city){
            $this->city_id = $this->city->id;
        }     
        if (Auth::check())
        {
            $this->user_id = Auth::user()->id;
        }

    }

    public function render()
    {

        return view('livewire.user.submit-property')
            ->extends('layouts.app',[       
                'metatitle'          => config('app.name').' | '. __('lang.submitnewproperty'),
                'metadescription'    => config('app.name').' | '. __('lang.submitnewproperty'),
                'metakeyword'        => __('lang.submitnewproperty')
        ]);
    }

    public function updatedStateId($stateId)
    {
        $this->allcities = City::where('state_id', $stateId)->get();
        $this->city = City::where('state_id', $stateId)->select('id')
            ->first();
        if ($this->city)
        {
            $this->city_id = $this
                ->city->id;
        }
        else
        {
            $this->city_id = '';
        }

    }
}

