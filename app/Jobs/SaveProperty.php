<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use  App\Models\State;
use  App\Models\City;
use App\Models\Property; 
use App\Models\ListUrl; 

class SaveProperty implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $url;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       // $url = "https://www.avendrealouer.fr/vente/le-bourget-93/b-appartement/2-pieces/loc-101-42814/fd-42428895.html"; 
        
       $response = Http::get($this->url);
        preg_match_all('/(AppAdview,(.*?)), document.getElementById/is', $response,$out);
      $data = json_decode(str_replace(')','',$out[2][0]),true);
      /* amenities */ 
      $amenities = [];

      $metakeyword = ''; 
      $metadesc    = ''; 

      if(isset($data['details']['Description']['Property']['Assets'])){
         $assets = $data['details']['Description']['Property']['Assets'];
         foreach($assets as $asset){
              if($asset == 'Cave'){
                array_push($amenities,'cellar');
                $metakeyword .= 'cellar';
              }
              if($asset == 'Balcon'){
                 array_push($amenities,'balcony');
                 $metakeyword .= ',balcony';
              }
              if($asset == 'Stationnement'){
                array_push($amenities,'garageparking');
                $metakeyword .= ',Stationnement';
              }
              
              if($asset == 'Lumineux'){
                array_push($amenities,'luminous');
                $metakeyword .= ',Lumineux';
              }
              if($asset == 'Ascenseur'){
                array_push($amenities,'elevator');
                $metakeyword .= ',Ascenseur';
              }
              if($asset == 'Parking'){
                array_push($amenities,'garageparking');
                $metakeyword .= ',Parking';
              }
              if($asset == 'Au calme'){
                array_push($amenities,'calm');
                $metakeyword .= ',Au calme';
              }
              if($asset == 'Cuisine équipée'){
                array_push($amenities,'equippedkitchen');
                $metakeyword .= ',Cuisine équipée';
              }
              if($asset == 'Cuisine équipée'){
                array_push($amenities,'equippedkitchen');
                $metakeyword .= ',Cuisine équipée';
              }
              if($asset == 'Cheminée'){
                array_push($amenities,'fireplace');
                $metakeyword .= ',Cheminée';
              }
              if($asset == 'Rez-de-jardin'){
                array_push($amenities,'garden');
                $metakeyword .= ',garden';
              }
              if($asset == 'WC séparé'){
                array_push($amenities,'separatetoilet');
                $metakeyword .= ',WC séparé';
              }
         }
         
      }
      if(isset($data['details']['Description']['ExteriorCharacteristics'])){
       $exteriorCharacteristics = $data['details']['Description']['ExteriorCharacteristics'];
         foreach($exteriorCharacteristics as $exterior){
              if($exterior['Name'] == 'Garage' || $exterior['Name'] == 'Parking'){
                  array_push($amenities,'garageparking');
              }
              if($exterior['Name'] == 'Balcon'){
                 array_push($amenities,'balcony');
                 $metakeyword .= ','.__('lang.balcony');
              }
              if($exterior['Name'] == 'Terrasse'){
                array_push($amenities,'terrace');
                $metakeyword .= ','.__('lang.terrace');
              }
              if($exterior['Name'] == 'Jardin'){
                array_push($amenities,'garden');
                $metakeyword .= ','.__('lang.garden');
              }
              if($exterior['Name'] == 'Cave'){
                array_push($amenities,'cellar');
                $metakeyword .= ','.__('lang.cellar');
              }
              if($exterior['Name'] == 'Piscine'){
                array_push($amenities,'swimmingpool');
                $metakeyword .= ','.__('lang.swimmingpool');
              }
              if($exterior['Name'] == 'Tennis'){
                array_push($amenities,'tennis');
                $metakeyword .= ','.__('lang.tennis');
              }
              
         }

      }
      if(isset($data['details']['Description']['InteriorCharacteristics'])){
         $interiorA = $data['details']['Description']['InteriorCharacteristics'];
         foreach($interiorA as $interior){
           if($interior['ID'] == 'Heatings'){
              array_push($amenities,'heater');
              $metakeyword .= ','.__('lang.heater');
           }
           if($interior['Name'] == 'Cuisine équipée'){
              array_push($amenities,'equippedkitchen');
              $metakeyword .= ','.__('lang.equippedkitchen');
            }
            if($interior['Name'] == 'Cuisine américaine'){
                array_push($amenities,'americankitchen');
                $metakeyword .= ','.__('lang.americankitchen');
            }
            if($interior['Name'] == 'Toilettes séparées'){
              array_push($amenities,'separatetoilet');
              $metakeyword .= ','.__('lang.separatetoilet');
            }
            if($interior['Name'] == 'Baignoire'){
              array_push($amenities,'bathtub');
              $metakeyword .= ','.__('lang.bathtub');
            }
            if($interior['Name'] == 'Cheminée'){
              array_push($amenities,'fireplace');
              $metakeyword .= ','.__('lang.fireplace');
            }
            if($interior['Name'] == 'Climatisation'){
              array_push($amenities,'airconditioner');
              $metakeyword .= ','.__('lang.airconditioner');
            }
            if($interior['Name'] == 'Placards'){
              array_push($amenities,'cupboards');
              $metakeyword .= ','.__('lang.cupboards');
            }
            if($interior['Name'] == 'Parquet'){
              array_push($amenities,'parquet');
              $metakeyword .= ','.__('lang.parquet');
            }
            if($interior['Name'] == 'Alarme'){
            array_push($amenities,'alarm');
              $metakeyword .= ','.__('lang.alarm');
            }
            if($interior['Name'] == 'Grenier'){
                  array_push($amenities,'attic');
                  $metakeyword .= ','.__('lang.attic');
            }
         }
      } 
  
      if(isset($data['details']['Description']['BuildingCharacteristics'])){
        $building = $data['details']['Description']['BuildingCharacteristics'];
        
        foreach($building  as $build){
           if($build['Name'] == 'Ascenseur'){
              array_push($amenities,'elevator');
              $metakeyword .= ','.__('lang.elevator');
           }
           if($build['Name'] == 'Gardien'){
              array_push($amenities,'guardian');
              $metakeyword .= ','.__('lang.guardian');
            }
            if($build['Name'] == 'Digicode'){
              array_push($amenities,'digicode');
              $metakeyword .= ','.__('lang.digicode');
            }
            if($build['Name'] == 'Interphone'){
               array_push($amenities,'intercom');
               $metakeyword .= ','.__('lang.intercom');
            }
         }
      }
      //return array_unique($amenities);

      /* $propertytype   */
      if(isset($data['details']['PropertyTypeLabel'])){
        if($data['details']['PropertyTypeLabel'] == 'Appartement'){
          $propertytype = 'apartment';
          $metadesc     .= __('lang.apartment');
          $metakeyword .= ','.__('lang.apartment');
        }else if($data['details']['PropertyTypeLabel'] == 'Maison'){
           $propertytype = 'houses';
           $metakeyword .= ','.__('lang.houses');
           $metadesc     .= __('lang.houses');
        }else if($data['details']['PropertyTypeLabel'] == 'Terrain'){
              $propertytype = 'ground';
              $metakeyword .= ','.__('lang.ground');
              $metadesc     .= __('lang.ground');
        }else if($data['details']['PropertyTypeLabel'] == 'Local commercial'){
              $propertytype = 'commercial';
              $metakeyword .= ','.__('lang.commercial');
              $metadesc     .= __('lang.commercial');
        }else if($data['details']['PropertyTypeLabel'] == 'Parking'){
              $propertytype = 'garage';
              $metakeyword .= ','.__('lang.garage');
              $metadesc     .= __('lang.garage');
        }else if($data['details']['PropertyTypeLabel'] == 'Bureau'){
              $propertytype = 'offices';
              $metadesc     .= __('lang.offices');
              $metakeyword .= ','.__('lang.offices');
        }else if($data['details']['PropertyTypeLabel'] == 'Château'){
              $propertytype = 'villas';
              $metadesc     .= __('lang.villas');
              $metakeyword .= ','.__('lang.villas');
        }else{
           $propertytype = 'houses';
           $metakeyword .= ','.__('lang.houses');
           $metadesc     .= __('lang.houses');
        } 
    }

     /* $status   */
       if(isset($data['details']['PropertyTransactionLabel'])){
            if($data['details']['PropertyTransactionLabel'] == 'Vente'){
                $status = 'sale';
            }else{
              $status = 'rent';
           }
        }
        /* $buildon   */
         $buildon = '';
        if(isset($data['details']['CacheHeaders']['Value']['ConstructionDate'])){

          $year =  Carbon::parse($data['details']['CacheHeaders']['Value']['ConstructionDate']);
          $buildon = $year->isoFormat('YYYY');
         }

        /* $photo   */
        $photopaths = '';
        $thumbnailpaths = '';
        if(isset($data['details']['CacheHeaders']['Value']['Photos'])){
          $photos = $data['details']['CacheHeaders']['Value']['Photos'];
          $numItems = count($photos);
          $i = 0;
    
         foreach($photos as $photo){
//$filename = $i . '-' . time() . '-' .Str::slug($data['details']['CacheHeaders']['Value']['Title'], '-').'.jpg';
                     // $path = 'images/property/' . $filename;
                      //Image::make($photo['Url'])->resize(800,600)
                          //->save(public_path('/') . $path);
                          if(++$i === $numItems) {
                              $photopaths .= $photo['Url'];
                          }else{
                             $photopaths .= $photo['Url'].",";
                         }
          }

          for($j = 0;$j < 2 ; $j++){
           // $filename = $j . '-' . time() . '-' .Str::slug($data['details']['CacheHeaders']['Value']['Title'], '-').'.jpg';
           // $path = 'images/property/thumbnail/' . $filename;

            //Image::make($photos[$j]['Url'])->resize(280,220)
              //  ->save(public_path('/') . $path);
                $img = $photos[$j]['Url'];
                $img= str_replace('resize-to-jpeg','big-thumbnail',$img);
                if(++$i === $numItems) {
                    $thumbnailpaths .= $img;
                }else{
                    $thumbnailpaths .= $img.",";  
               }
          }

      
        }
        
      
        /*check region*/
        $state_id = '';
        if(isset($data['details']['CacheHeaders']['Value']['Region']['Name'])){
          $namestate = $data['details']['CacheHeaders']['Value']['Region']['Name'];
          $state = State::where('state','like','%'.$namestate.'%')->first();
           if(!empty($state)){
            $state_id =  $state->id;
           }else{
            $state_id = State::insertGetId([
                'state' => $namestate,
                'slug'  => Str::slug($namestate, '-') 
             ]);
           }
        }

       if(!empty($state_id)){
          $city_id = '';
          if(isset($data['details']['CacheHeaders']['Value']['Town']['Name'])){
                 $namecity = $data['details']['CacheHeaders']['Value']['Town']['Name'];
                 $city = City::where('city','like','%'.$namecity.'%')->first();
            if(!empty($city)){
                $city_id =  $city->id;
                $metadesc     .= __('lang.in').' '.$city->city;
             }else{
                $city_id = City::insertGetId([
                    'city'      => $namecity,
                    'state_id'  => $state_id,
                    'slug'      => Str::slug($namecity,'-') 
                ]);
                $metadesc     .= __('lang.in').' '.$namecity;
             }
          }
        }
        $phone;
        if(!empty($data['details']['CacheHeaders']['Value']['Contact']['PhoneNumber'])){
          $phone = $data['details']['CacheHeaders']['Value']['Contact']['PhoneNumber'];
        }else{
          preg_match('/"InfosContact":"(.*?)"}/is', $response, $out);
          $phone = $out[1];
        }
        
        if(isset($data['details']['CacheHeaders']['Value']['Description'])){
          $metadesc     .= __('lang.buildon').' '.$data['details']['CacheHeaders']['Value']['Description']; 
        }


        if(isset($data['details']['CacheHeaders']['Value']['BedroomsCount'])){
          $metadesc     .= __('lang.has').' '.$data['details']['CacheHeaders']['Value']['BedroomsCount'].' '.__('lang.bedrooms'); 
        }

        if(isset($data['details']['CacheHeaders']['Value']['BathroomsCount'])){
          $metadesc     .= __('lang.with').' '.$data['details']['CacheHeaders']['Value']['BedroomsCount'].' '.__('lang.bathrooms'); 
        }

        if(isset($data['details']['CacheHeaders']['Value']['RoomsCount'])){
          $metadesc     .= __('lang.and').' '.$data['details']['CacheHeaders']['Value']['RoomsCount'].' '.__('lang.rooms'); 
        }



       

       if(!empty($city_id)){
        $idproperty = Property::insertGetId([
          'title' => (isset($data['details']['CacheHeaders']['Value']['Title'])) ?  $data['details']['CacheHeaders']['Value']['Title'] : '',
          'metatitle'=> (isset($data['details']['CacheHeaders']['Value']['Title'])) ?  $data['details']['CacheHeaders']['Value']['Title'] : '',
          'metadescription'=>(isset($metadesc)) ? $metadesc : '',
          'metakeyword'=>(isset($metakeyword)) ? $metakeyword : '',  
          'slug'  => (isset($data['details']['CacheHeaders']['Value']['Title'])) ? Str::slug($data['details']['CacheHeaders']['Value']['Title'], '-') : '',
          'propertytype'=> $propertytype,
          'status'      => $status,
          'price'       => (isset($data['details']['CacheHeaders']['Value']['Price'])) ? $data['details']['CacheHeaders']['Value']['Price']:'',
          'energy'      => (isset($data['details']['CacheHeaders']['Value']['Diagnostic']['EnergySymbol'])) ? $data['details']['CacheHeaders']['Value']['Diagnostic']['EnergySymbol'] : 'virgin',         
          'ges'         => (isset($data['details']['CacheHeaders']['Value']['Diagnostic']['GasSymbol'])) ? $data['details']['CacheHeaders']['Value']['Diagnostic']['GasSymbol'] : 'virgin',
          'area'        => (isset($data['details']['CacheHeaders']['Value']['Surface'])) ? $data['details']['CacheHeaders']['Value']['Surface'] : '',
          'zipcode'     => (isset($data['details']['CacheHeaders']['Value']['Town']['PostalCode'])) ?   $data['details']['CacheHeaders']['Value']['Town']['PostalCode']: '',
          'address'     => (isset($data['details']['CacheHeaders']['Value']['Address'])) ? $data['details']['CacheHeaders']['Value']['Address'] : '',
          'description' => (isset($data['details']['CacheHeaders']['Value']['Description'])) ?  $data['details']['CacheHeaders']['Value']['Description'] : '',
          'buildon'     => (!empty($buildon)) ?   $buildon  : '',
          'bedrooms'    => (isset($data['details']['CacheHeaders']['Value']['BedroomsCount'])) ?  $data['details']['CacheHeaders']['Value']['BedroomsCount']:'',
          'bathrooms'   => (isset($data['details']['CacheHeaders']['Value']['BathroomsCount'])) ?  $data['details']['CacheHeaders']['Value']['BathroomsCount']: 1,
  
          'rooms'         =>  (isset($data['details']['CacheHeaders']['Value']['RoomsCount'])) ?  $data['details']['CacheHeaders']['Value']['RoomsCount']: 1,
          'features'      =>  (!empty($amenities)) ? json_encode(array_unique($amenities)) : '',
          'photos'        =>   (isset($photopaths)) ? $photopaths : '',
          'thumbnails'    =>   (isset($thumbnailpaths)) ? $thumbnailpaths : '',
          'name'          =>  (isset($data['details']['CacheHeaders']['Value']['Contact']['Name'])) ? $data['details']['CacheHeaders']['Value']['Contact']['Name'] : '',
          'email'         =>  (isset($data['details']['CacheHeaders']['Value']['Contact']['ContactEmail'])) ? $data['details']['CacheHeaders']['Value']['Contact']['ContactEmail'] : '',
          'phone'         =>  (isset($phone)) ? $phone : '',
          'poststatus'    =>  'published',
          'scrapurl'      =>   ($this->url != '') ? $this->url : '',
          'city_id'      =>   $city_id
          
          ]);

          Property::where('id',$idproperty)->update([
             'slug'=> Str::slug($data['details']['CacheHeaders']['Value']['Title']. '-' . $idproperty, '-')
          ]);
       }
       



    }
}
