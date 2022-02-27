<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\State;
use App\Models\City;
use App\Models\Property;

class ListingProperties extends Component
{
    use WithPagination;

     protected $paginationTheme = 'bootstrap';
    public $allcities = [];
    public $stateId;
    public $allstate;
    public $city;
    public $city_id;
    protected $listeners = ['search','top'];
    /* */

    public $type = "apartment";
    public $minprice;
    public $maxprice;
    public $bedrooms;
    public $bathrooms;
    public $status = "rent";


    /* */
    
   // private $proprites;
    //public $count = 0 ;
    public $order = 'latest';
    
   private  $data;
   private  $count;

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

             $data = Property::where('poststatus','published')->list();
                    if($this->city){
                        $data->where('city_id',$this->city_id);
                    }

    

                    if($this->type != null){
                        $data->where('propertytype',$this->type);
                    }
                    
                    if($this->minprice != null){
                        $data->whereRaw('CONVERT(price,SIGNED) >= '.$this->minprice);
                    }

                    if($this->maxprice != null){
                        $data->whereRaw('CONVERT(price,SIGNED) <= '.$this->maxprice);
                    }

                    if($this->status != null){
                        $data->where('status',$this->status);
                    }
                     
                    if($this->bedrooms){
                        $data->where('bedrooms','=',$this->bedrooms);
                    }

                    if($this->bathrooms){
                        $data->where('bathrooms','=',$this->bathrooms);
                    }


                   $this->count = $data->count();
                   $this->data  = $data->paginate(8);

                   if(count($this->data) > 0){
                    foreach($this->data as $p){
                       $images = explode(',',$p->thumbnails);
                        $p->thumbnails = $images; 
                    }                               
                }
                 
                  $this->top();
        }
        public function top(){
            
         return session()->flash('top','');
        }

        public function updatedOrder(){
            $data = Property::where('poststatus','published')->list();
            if($this->order == "price"){
                $data->orderByRaw('CONVERT(price,SIGNED) desc');
            }
            if($this->order == "buildon"){
                $data->orderByRaw('CONVERT(buildon, SIGNED) desc');
            }
            if($this->order == "latest"){
                $data->orderByDesc('id');
            }
            $this->count = $data->count();
            $this->data  = $data->paginate(8);
            if(count($this->data) > 0){
                foreach($this->data as $p){
                   $images = explode(',',$p->thumbnails);
                    $p->thumbnails = $images; 
                }                               
            }
      
        }

        public function render()
        {
            /*
            $default = Property::where('poststatus','published')->list();
            $count = $default->count();
            if($this->type != null){
                $default->where('propertytype',$this->type);
            }
            
            if($this->minprice != null){
                $default->whereRaw('CONVERT(price,SIGNED) >= '.$this->minprice);
            }

            if($this->maxprice != null){
                $default->whereRaw('CONVERT(price,SIGNED) <= '.$this->maxprice);
            }

            if($this->status != null){
                $default->where('status',$this->status);
            }
          */

            $defaultdata =  Property::where('poststatus','published')->list()->paginate(8);
            if(count($defaultdata) > 0){
                foreach($defaultdata as $p){
                   $images = explode(',',$p->thumbnails);
                    $p->thumbnails = $images; 
                }                               
            }
      
            return view('livewire.listing-properties',['data'=>$this->data ?? $defaultdata,'count'=>$this->count ?? count($defaultdata)])
            ->extends('layouts.app',[       
                'metatitle'          => config('app.name').' | '. __('lang.propertylist'),
                'metadescription'    => config('app.name').' | '. __('lang.propertylisttitle'),
                'metakeyword'        => __('lang.propertylist')
        ]);
        }
}


