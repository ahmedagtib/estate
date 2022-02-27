<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;
use App\Models\State;
use App\Models\City;
use App\Models\Setting;


class SearchForm extends Component
{

    public $allcities = [];
    public $stateId;
    public $allstate;
    public $city;
    public $city_id;
    /* */
    public $type   = 'apartment';
    public $status = 'rent';
    public $minprice; 
    public $maxprice; 
    public $bedrooms;
    public $bathrooms;

    public function search(){
        $this->validate([
            'type'        =>  'required|in:houses,apartment,villas,commercial,offices,garage,ground',
            'status'      =>  'required|in:rent,sale',
            'minprice'    =>  'nullable|numeric',
            'maxprice'    =>  'nullable|numeric',
            'bedrooms'    =>  'nullable|numeric|min:1|max:5',
            'bathrooms'   =>  'nullable|numeric|min:1|max:5',
            'city_id'     =>  'nullable|exists:cities,id'
         ],[],[
            'type'        =>  __('lang.propertytype'),
            'status'      =>  __('lang.status'),
            'minprice'    =>  __('lang.minprice'),
            'maxprice'    =>  __('lang.maxprice'),
            'bedrooms'    =>   __('lang.bedrooms'),
            'bathrooms'   =>  __('lang.bathrooms'),
            'city_id'     =>  __('lang.city')
         ]);

         $status      = $this->status;
         $type        = $this->type;
         $minprice    = $this->minprice;
         $maxprice    = $this->maxprice;
         $bedrooms    = $this->bedrooms;
         $bathrooms   = $this->bathrooms;
         $city        = $this->city_id;

        

         if(!empty($city)){
            $nameOfcity = City::where('id',$city)->first('slug');
          }

          $slug = "";

       if(!empty($type)){
          $slug .= $type."-";
       }

       if(!empty($status)){
         $slug .= "".__('lang.forslug')."-".$status."-";
       }

       if(!empty($minprice)){
    
         $slug .= "".__('lang.betweenslug')."-".$minprice."-";
       }
       if(!empty($maxprice)){
          $slug .= "".__('lang.andslug')."-".$maxprice."-";
       }
       if(!empty($bedrooms)){
        $slug .= $bedrooms."-".__('lang.bedroomsslug')."-";
       }
       if(!empty($bathrooms)){
        $slug .= $bathrooms."-".__('lang.bathroomsslug')."-";
       }
       if(!empty($nameOfcity)){
        $slug .= "".__('lang.inslug')."-".$nameOfcity->slug."";
       }
      
       return redirect()->route('search.properties',['slug'=>$slug]);
    

     
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
    public function render()
    {
         $setting = Setting::first('button_search_form');
         $button = isset($setting->button_search_form) ?  $setting->button_search_form : '';
        //button_search_form
        return view('livewire.component.search-form',['button'=>$button]);
    }
}
