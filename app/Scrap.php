<?php
namespace App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use  App\Models\State;
use  App\Models\City;
use  App\Models\Property;

class Scrap 
{

   

  public function getdata(){ 
    /*
    try{
       //for($i = 1; $i < 10;$i++){
         $i = 0;
         $data = [];

        $response = Http::get('https://www.avendrealouer.fr/recherche.html?pageIndex='.$i.'&sortPropertyName=ReleaseDate&sortDirection=Descending&searchTypeID=1&typeGroupCategoryID=1&localityIds=2-82,2-53,2-24,2-26,2-94,2-11,2-25,2-23,2-72,2-52,2-93&typeGroupIds=1,2,3,4,5,6,7,8,9,10,11&searchId=client-637584014457120000&hasAlert=false');
        preg_match_all('/<a href="\/vente\/(.*?).html"/is',$response,$out);
              
      
     

        //array_merge($listUrl,$out[1]);
      // }

      return  $listUrl; 
       
     } catch (Exception $e) { 
       var_dump($e->getMessage());
     }
     */
  }

  public function getproperty(){
    try{
      $url = "https://www.avendrealouer.fr/vente/paris-75/b-appartement/5-pieces/loc-101-36374/fd-42122341.html"; 
      $response = Http::get($url);
      preg_match_all('/(AppAdview,(.*?)), document.getElementById/is', $response, $out);
      $data = json_decode(str_replace(')','',$out[2][0]),true);

      /* amenities */ 
      $amenities = [];

      if(isset($data['details']['Description']['Property']['Assets'])){
         $assets = $data['details']['Description']['Property']['Assets'];
         foreach($assets as $asset){
              if($asset == 'Cave'){
                array_push($amenities,'cellar');
              }
              if($asset == 'Balcon'){
                 array_push($amenities,'balcony');
              }
              if($asset == 'Stationnement'){
                array_push($amenities,'garageparking');
              }
              if($asset == 'Stationnement'){
                array_push($amenities,'garageparking');
              }
              if($asset == 'Lumineux'){
                array_push($amenities,'luminous');
              }
              if($asset == 'Ascenseur'){
                array_push($amenities,'elevator');
              }
              if($asset == 'Parking'){
                array_push($amenities,'garageparking');
              }
              if($asset == 'Au calme'){
                array_push($amenities,'calm');
              }
              if($asset == 'Cuisine équipée'){
                array_push($amenities,'equippedkitchen');
              }
              if($asset == 'Cuisine équipée'){
                array_push($amenities,'equippedkitchen');
              }
              if($asset == 'Cheminée'){
                array_push($amenities,'fireplace');
              }
              if($asset == 'Rez-de-jardin'){
                array_push($amenities,'garden');
              }
              if($asset == 'WC séparé'){
                array_push($amenities,'separatetoilet');
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
              }
              if($exterior['Name'] == 'Terrasse'){
                array_push($amenities,'terrace');
              }
              if($exterior['Name'] == 'Jardin'){
                array_push($amenities,'garden');
              }
              if($exterior['Name'] == 'Cave'){
                array_push($amenities,'cellar');
              }
              if($exterior['Name'] == 'Piscine'){
                array_push($amenities,'swimmingpool');
              }
              if($exterior['Name'] == 'Tennis'){
                array_push($amenities,'tennis');
              }
              
         }

      }
      if(isset($data['details']['Description']['InteriorCharacteristics'])){
         $interiorA = $data['details']['Description']['InteriorCharacteristics'];
         foreach($interiorA as $interior){
           if($interior['ID'] == 'Heatings'){
              array_push($amenities,'heater');
           }
           if($interior['Name'] == 'Cuisine équipée'){
              array_push($amenities,'equippedkitchen');
            }
            if($interior['Name'] == 'Cuisine américaine'){
                array_push($amenities,'americankitchen');
            }
            if($interior['Name'] == 'Toilettes séparées'){
              array_push($amenities,'separatetoilet');
            }
            if($interior['Name'] == 'Baignoire'){
              array_push($amenities,'bathtub');
            }
            if($interior['Name'] == 'Cheminée'){
              array_push($amenities,'fireplace');
            }
            if($interior['Name'] == 'Climatisation'){
              array_push($amenities,'airconditioner');
            }
            if($interior['Name'] == 'Placards'){
              array_push($amenities,'cupboards');
            }
            if($interior['Name'] == 'Parquet'){
              array_push($amenities,'parquet');
            }
            if($interior['Name'] == 'Alarme'){
            array_push($amenities,'alarm');
            }
            if($interior['Name'] == 'Grenier'){
                  array_push($amenities,'attic');
            }
         }
      } 
  
      if(isset($data['details']['Description']['BuildingCharacteristics'])){
        $building = $data['details']['Description']['BuildingCharacteristics'];
        
        foreach($building  as $build){
           if($build['Name'] == 'Ascenseur'){
              array_push($amenities,'elevator');
           }
           if($build['Name'] == 'Gardien'){
              array_push($amenities,'guardian');
            }
            if($build['Name'] == 'Digicode'){
              array_push($amenities,'digicode');
            }
            if($build['Name'] == 'Interphone'){
               array_push($amenities,'intercom');
            }
         }
      }
      //return array_unique($amenities);

      /* $propertytype   */
      if(isset($data['details']['PropertyTypeLabel'])){
        if($data['details']['PropertyTypeLabel'] == 'Appartement'){
          $propertytype = 'apartment';
        }else if($data['details']['PropertyTypeLabel'] == 'Maison'){
           $propertytype = 'houses';
        }else if($data['details']['PropertyTypeLabel'] == 'Terrain'){
              $propertytype = 'ground';
        }else if($data['details']['PropertyTypeLabel'] == 'Local commercial'){
              $propertytype = 'commercial';
        }else if($data['details']['PropertyTypeLabel'] == 'Parking'){
              $propertytype = 'garage';
        }else if($data['details']['PropertyTypeLabel'] == 'Bureau'){
              $propertytype = 'offices';
        }else if($data['details']['PropertyTypeLabel'] == 'villas'){
              $propertytype = 'Château';
        }else{
           $propertytype = 'houses';
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
        if(isset($data['details']['CacheHeaders']['Value']['Photos'])){
          $photos = $data['details']['CacheHeaders']['Value']['Photos'];
          $numItems = count($photos);
          $i = 0;
    
         foreach($photos as $photo){
           $filename = $i . '-' . time() . '-' .Str::slug($data['details']['CacheHeaders']['Value']['Title'], '-').'.jpg';
                      $path = 'images/property/' . $filename;
                      Image::make($photo['Url'])->resize(872, 579)
                          ->save(public_path('/') . $path);
                          if(++$i === $numItems) {
                              $photopaths .= $path;
                          }else{
                             $photopaths .= $path.",";
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
             }else{
                $city_id = City::insertGetId([
                    'city'      => $namecity,
                    'state_id'  => $state_id,
                    'slug'      => Str::slug($namecity,'-') 
                ]);
             }
          }
        }

       if(!empty($city_id)){
       $idproperty = Property::insertGetId([
          'title' => (isset($data['details']['CacheHeaders']['Value']['Title'])) ?  $data['details']['CacheHeaders']['Value']['Title'] : '',
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
          'photos'        =>   (!empty($photopaths)) ? $photopaths : '',
          'name'          =>  (isset($data['details']['CacheHeaders']['Value']['Contact']['Name'])) ? $data['details']['CacheHeaders']['Value']['Contact']['Name'] : '',
          'email'         =>  (isset($data['details']['CacheHeaders']['Value']['Contact']['ContactEmail'])) ? $data['details']['CacheHeaders']['Value']['Contact']['ContactEmail'] : '',
          'phone'         =>  (isset($data['details']['CacheHeaders']['Value']['Contact']['PhoneNumber'])) ? $data['details']['CacheHeaders']['Value']['Contact']['PhoneNumber'] : '',
          'poststatus'    =>  'published',
          'scrapurl'      =>   ($url != '') ? $url : '',
          'city_id'      =>   $city_id
          
          ]);

          Property::where('id',$idproperty)->update([
             'slug'=> Str::slug($data['details']['CacheHeaders']['Value']['Title']. '-' . $idproperty, '-')
          ]);
       }

        
       return "ok";
  
   } catch (Exception $e) { 
     var_dump($e->getMessage());
   }
  }



}
