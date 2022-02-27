<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Property;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\City;
use App\Models\State;
use App\Models\Page;
use App\Models\Setting;
use App\Models\theme;
use \PDF;


class FrontController extends Controller
{
  
   /************************* home **********************************/
   public  function homepage(){
       
      $about = Setting::first(['hero_title','hero_content','find_by_locations','meta_title','meta_description','meta_keyword']);
      $data = Property::where('poststatus','published')->selection()->orderBy('id','DESC')->take(6)->get();
      
    
      foreach($data as $p){
         $images = explode(',',$p->thumbnails);
         $p->thumbnails = $images; 
      }  
     
    
     
      $location = !empty($about->find_by_locations) ? json_decode($about->find_by_locations) : []; 
      $blogs = Post::where('statue','publiched')->orderBy('id', 'DESC')->take(3)->get();
     
       $meta_title = $about->meta_title ??  config('helper.metatitle');
       $meta_description =  $about->meta_description ?? config('helper.metadescription');
       $meta_keyword =  $about->meta_keyword ?? config('helper.metakeyword');
       $theme = theme::first('landing_page'); 
       
      return view('index',[
         'about'    =>$about,
         'data'     =>$data,
         'location' =>$location,
         'blogs'    =>$blogs,
         'metatitle'          => config('app.name').' | '.$meta_title ,
         'metadescription'    => config('app.name').' | '.$meta_description,
         'metakeyword'        => $meta_keyword,
         'theme'              => $theme->landing_page

      ]); 
   }
   
   /************************************************************/
   public  function list_properties($state = null,$city = null,$type = null){
      
      $data = Property::where('poststatus','published');

      //$title = __();

      /* state */

      if($state !=null){
          $data->whereHas('city',function($q) use ($state){
               $q->whereHas('state',function($q) use($state){
                  $q->where('slug',$state);
               });
          });


      }

      if($city != null){
         $data->whereHas('city',function($q) use ($city){
               $q->where('slug',$city);
         });
      }

      if($type != null){
          $data->where('propertytype',$type);
      }
      $count = $data->count();  
      $data  = $data->paginate(9);

     if($count > 0){
        $title = '';
        $metadescription = '';
        if($state !=null && $city == null && $type == null){
           $statename = State::where('slug',$state)->first(); 
           $title = __('lang.allproperties').' '.__('lang.in').' '.$statename->state;  
           $metadescription = __('lang.mostthan').' '.$count .' '.__('lang.properties').' '.__('lang.in').' '.$statename->state;  
        }
        if($state !=null && $city != null && $type == null){
         $cityname = City::where('slug',$city)->first(); 
         $title = __('lang.allproperties').' '.__('lang.in').' '.$cityname->city;  
         $metadescription = __('lang.mostthan').' '.$count .' '.__('lang.properties').' '.__('lang.in').' '.$cityname->city;
        }
        if($state !=null && $city != null && $type != null){
         $cityname = City::where('slug',$city)->first(); 
            if ($type == 'apartment') {
               $title = __('lang.all').' '.__('lang.apartment').' '.__('lang.in').' '.$cityname->city;  
               $metadescription = __('lang.mostthan').' '.$count .' '.__('lang.apartment').' '.__('lang.in').' '.$cityname->city;
             }elseif($type  == 'houses'){
                $title = __('lang.all').' '.__('lang.houses').' '.__('lang.in').' '.$cityname->city;  
                $metadescription = __('lang.mostthan').' '.$count .' '.__('lang.houses').' '.__('lang.in').' '.$cityname->city;
             }elseif($type  == 'villas'){
               $title = __('lang.all').' '.__('lang.villas').' '.__('lang.in').' '.$cityname->city;  
               $metadescription = __('lang.mostthan').' '.$count .' '.__('lang.villas').' '.__('lang.in').' '.$cityname->city;
             }elseif($type  == 'commercial'){
               $title = __('lang.all').' '.__('lang.commercial').' '.__('lang.in').' '.$cityname->city; 
               $metadescription = __('lang.mostthan').' '.$count .' '.__('lang.commercial').' '.__('lang.in').''.$cityname->city; 
             }elseif($type  == 'offices'){
               $title = __('lang.all').' '.__('lang.offices').' '.__('lang.in').' '.$cityname->city;
               $metadescription = __('lang.mostthan').' '.$count .' '.__('lang.offices').' '.__('lang.in').' '.$cityname->city; 
             }elseif($type  == 'garage'){ 
               $title = __('lang.all').' '.__('lang.garage').' '.__('lang.in').' '.$cityname->city; 
               $metadescription = __('lang.mostthan').' '.$count .' '.__('lang.garage').' '.__('lang.in').' '.$cityname->city; 
             }elseif($type == 'ground'){ 
              $title = __('lang.all').' '.__('lang.ground').' '.__('lang.in').' '.$cityname->city;
              $metadescription = __('lang.mostthan').' '.$count .' '.__('lang.ground').' '.__('lang.in').' '.$cityname->city; 
            }
       
        }

        foreach($data as $p){
           $images = explode(',',$p->thumbnails);
           $p->thumbnails = $images; 
         }  


      return view('search',[
                    'data'=>$data,
                    'count'=>$count,
                    'title'=>$title,
                    'metatitle'=>$title,
                    'metadescription'=> $metadescription
                  ]);
     }else{
        return view('errors.404');
     }
      

   }

   public  function properties_for_rent(){
        $data  = Property::where('status','rent')->where('poststatus','published')->selection();
        $count = $data->count();
        $data = $data->paginate(9);  
        foreach($data as $p){
         $images = explode(',',$p->thumbnails);
         $p->thumbnails = $images; 
       }  
        return view('search',['data'=>$data,'count'=>$count,'title'=>__('lang.propertiesrent'),      
         'metatitle'          => config('app.name').' | '. __('lang.propertiesrent'),
         'metadescription'    => config('app.name').' | '. __('lang.propertiesrent'),
         'metakeyword'        => __('lang.propertiesrent')
       ]);
   }
   
   public function properties_for_sale(){
        $data  = Property::where('status','sale')->where('poststatus','published');
        $count = $data->count();
        $data =  $data->paginate(9);  
        foreach($data as $p){
         $images = explode(',',$p->thumbnails);
         $p->thumbnails = $images; 
       }  
        return view('search',['data'=>$data,'count'=>$count,'title'=>__('lang.propertiessale'),      
        'metatitle'          => config('app.name').' | '. __('lang.propertiessale'),
        'metadescription'    => config('app.name').' | '. __('lang.propertiessale'),
        'metakeyword'        => __('lang.propertiessale')
      ]);
   }

   
   public   function searchproperties($slug){
      $type  = preg_match('/(.*?)-/is',$slug,$out)?$out[1]:null;
      $status    =preg_match('/'.__('lang.forslug').'-(.*?)-/is', $slug, $out)?$out[1]:null;
      $minprice  =preg_match('/'.__('lang.betweenslug').'-(.*?)-/is', $slug, $out)?$out[1]:null;
      $maxprice  =preg_match('/'.__('lang.andslug').'-(.*?)-/is', $slug, $out)?$out[1]:null;
      $maxprice  =preg_match('/'.__('lang.andslug').'-(.*?)-/is', $slug, $out)?$out[1]:null;
      $newslug   =str_replace(''.$type.'-'.__('lang.forslug').'-'.$status.'-'.__('lang.between').'-'.$minprice.'-'.__('lang.and').'-'.$maxprice.'',"",$slug);
      $bedrooms  =preg_match('/-(.*?)-'.__('lang.bedroomsslug').'/is', $newslug, $out)?preg_replace('/[^0-9]/','',substr(strrchr($out[1],"-"),1)):null;
     
     // preg_replace('/[^0-9]/','',substr(strrchr($out[1],"-"),1));
       if(empty($bedrooms)){
         //return $newslug;
         $bathrooms =preg_match('/-'.__('lang.bedroomsslug').'-(.*?)-/is', $newslug,$out)?$out[1]:null;
       }else{
          
          $bathrooms = preg_match('/-(\d)-'.__('lang.bathroomsslug').'/is',$newslug,$out)?$out[1]:null;
          
       }
       
        
       $cityslug  = preg_match('/'.__('lang.inslug').'-(.*?)\//is',$slug."/", $out)?$out[1]:null;
       if(!empty($cityslug)){
         $objectCity = City::where('slug',$cityslug)->first();
       }
            //generate title 
        $data="";
         if (!empty($type)) {
           $t = '';
           if ($type == 'apartment') {
             $t = __('lang.apartment');
           }elseif($type == 'houses'){
              $t = __('lang.houses');
           }elseif($type == 'villas'){
               $t = __('lang.villas');
           }elseif($type == 'commercial'){
              $t = __('lang.commercial');
           }elseif($type == 'offices'){
              $t = __('lang.offices');
           }elseif($type == 'garage'){ 
               $t = __('lang.garage');
           }elseif($type == 'ground'){ 
            $t = __('lang.ground');
          }
           $data .="".__('lang.the')." ".$t." ";
         }
        if (!empty($status)){
           $s = '';
           if ($status == 'rent') {
               $s = __('lang.rent');
           }else{
              $s = __('lang.sale');
           }
           $data .="".__('lang.for')." ".$s." ";
        }
        if($minprice > 0){
           $data .="".__('lang.pricebetween')." ".$minprice." ";
        }
        if (!empty($maxprice)) {

            $data .="".__('lang.and')." ".$maxprice." ";
         }
        if (!empty($bedrooms)) {
           $data .="".__('lang.has')." ".$bedrooms." ".__('lang.bedrooms').""." ";
         }
        if (!empty($bathrooms)) {
            $data .="".__('lang.and')." ".$bathrooms." ".__('lang.bathrooms').""." ";
         }
         if (!empty($objectCity->city)) {
           $data .=" ".__('lang.in')." ".$objectCity->city." ".__('lang.city')."";
         }

            
                    
            //start searsh  
         $property=Property::where('poststatus','published'); 

        if (!empty($type)) {

           $property->Where('propertytype','=',$type); 
        }
        if (!empty($status)){
           $property->Where('status','=',$status); 
        }
        if($minprice > 0   && is_numeric($minprice)){
         //  $property->where('price','>=',$minprice);
           $property->whereRaw('CONVERT(price,SIGNED) >= '.$minprice);
        }
        if (!empty($maxprice)  && is_numeric($maxprice)) {
            $property->whereRaw('CONVERT(price,SIGNED) <= '.$maxprice);
        //   $property->where('price','<=',$maxprice);
         }
        if (!empty($bedrooms) && is_numeric($bedrooms)) {
           $property->Where('bedrooms',$bedrooms); 
         }
        if (!empty($bathrooms) && is_numeric($bathrooms)) {
           $property->Where('bathrooms',$bathrooms); 
         }
        if (!empty($cityId)) {
           $property->Where('city_id','=',$objectCity->id); 
        }
         $count = $property->count();
         $listofproperties = $property->orderBy('id','desc')->paginate(9); 
         foreach($listofproperties as $p){
            $images = explode(',',$p->thumbnails);
            $p->thumbnails = $images; 
          }  
         if($count > 0){
            return view('search',['data'=>$listofproperties,'count'=>$count,'title'=>$data,  
            'metatitle'          => config('app.name').' | '. $data,
            'metadescription'    => config('app.name').' | '. $data,
            'metakeyword'        => $data
         ]);
         }else{
            session()
            ->flash('error', __('lang.searchfaild'));
           return redirect()->route('home');
         }
    }


    /******************************  BLOG *********************************/

      /* return blog view [blog , blog by category ]*/
       
      public  function blogview($category = null) {
          if($category != null){
             $posts = Post::whereHas('category',function($q) use ($category){
                  $q->where('slug',$category);
             })->where('statue','publiched')->orderByDesc('id')->paginate(9);

             if(count($posts) > 0){
                return view('frontblog.blog',[
                              'data'=>$posts,
                              'option'=>'category',
                              'title'=>$category,
                              'metatitle'       => config('app.name').' | '.$category,
                              'metadescription' => __('lang.latesttag',['tag'=>$category]),
                              'metakeyword'    => $category
                           ]);
             }else{
                 return redirect()->route('404','404');
             }

         
          }else{
              $posts = Post::where('statue','publiched')->orderByDesc('id')->paginate(9);
              return view('frontblog.blog',[
                            'data'=>$posts,
                            'option'=>'blog',
                            'title'=>'blog',
                            'metatitle'       => config('app.name').' | Blogs' ,
                            'metadescription' => __('lang.blogdescription'),
                            'metakeyword'    => config('app.name')
                           ]);

          }

         
      }

       /* return blog view [ blog by tag ]*/

      public function tagview($tag){
        $posts = Post::whereHas('tags',function($q) use ($tag){
            $q->where('slug',$tag);
         })->where('statue','publiched')->orderByDesc('id')->paginate(9);

         if(count($posts) > 0){

            return view('frontblog.blog',[
                           'data'           =>$posts,
                           'option'         =>'tag',
                           'title'           => $tag,
                           'metatitle'       => config('app.name').'|'.$tag,
                           'metadescription' => __('lang.latesttag',['tag'=>$tag]),
                            'metakeyword'    => $tag
                        ]);
         }else{
            return redirect()->route('404','404');
         }
         
      }

      /****************** blog ***************** */

      public function blog($slug){
         $post = Post::where('slug',$slug)->where('statue','publiched')->first();
         if($post){
             $categories = Category::all();
             $posts      = Post::where('statue','publiched')->take(5)->get(['photo','title','slug','created_at']);
             $tags       = Tag::whereHas('posts')->take(10)->get(['tag','slug']);  
             $prev       = Post::where('id','<',$post->id)->where('statue','publiched')->first(['title','slug']);
             $next       = Post::where('id','>',$post->id)->where('statue','publiched')->first(['title','slug']);
             return view('frontblog.index',[
                           'post'         => $post,
                           'categories'   => $categories,
                           'tags'         => $tags,
                           'prev'         => $prev,
                           'next'         => $next,
                           'posts'        => $posts,
                           'metatitle'    => $post->title.'|'.config('app.name'),
                           'metadescription'=> $post->meta_description,
                           'metakeyword'   => $post->meta_keyword
                         ]);
         }

          return redirect()->route('404','404');
      }

      /****************** page ***************** */
      
      public function page($slug){
         $page = Page::where('slug',$slug)->first();
         if($page){
             return view('frontblog.page',[
                           'page'         => $page,
                           'metatitle'    => $page->title.'|'.config('app.name'),
                           'metadescription'=> $page->meta_description,
                           'metakeyword'   => $page->meta_keyword
                         ]);
         }

          return redirect()->route('404','404');
      }
      /************************** search blog *************************/
      public function searchblog(Request $request){
         // return $request->search;
          if(empty($request->search)){
            session()->flash('error',__('lang.searchinputvide'));
               return redirect()->route('blogs'); 
          }else{
             $posts = Post::where('title','like','%'.$request->search.'%')
                            ->orWhere('content','like','%'.$request->search.'%')
                            ->paginate(9);
                  
             return view('frontblog.blog',[
                        'data'=>$posts,
                        'option'=>'search',
                        'title'=>$request->search,
                        'metatitle'=> config('app.name').'|'.$request->search,
                        'metadescription'=> $request->search,
                        'metakeyword'=> $request->search
                     ]);               
                         
          }
      }


    /*********************************************************************/

    /* return single  property*/
    public  function property($slug) {
        
        $property = Property::where('slug',$slug)->first();
        if(!empty($property)){
             $images = explode(',',$property->photos);
             $property->photos = $images; 
            $propertyreleted = Property::where('propertytype',$property->propertytype)
                                         ->where('city_id',$property->city_id)
                                         ->where('id','!=',$property->id)
                                         ->where('poststatus','published')
                                         ->list()
                                         ->take(3)
                                         ->get();
           if(count($propertyreleted) > 0){
                foreach($propertyreleted as $p){
                   $images = explode(',',$p->thumbnails);
                    $p->thumbnails = $images; 
               }                               
           }


            $theme = theme::first('property_view');    
            
            $metatitle = $property->title;                    
             if($property->poststatus == 'published'){
              
                return view('property',['property'=>$property,
                                        'propertyreleted'=>$propertyreleted,
                                        'theme'=>$theme->property_view,
                                        'metatitle'=>$property->metatitle,
                                        'metadescription'=>$property->metadescription,
                                        'metakeyword'=>$property->metakeyword
                                       ]);
             }else{
                 if(Auth::check()){
                     if($property->user_id == Auth::user()->id || Auth::user()->hasRole('Admin')){
                        //return $property;
                        return view('property',[
                                                'property'=>$property,
                                                'propertyreleted'=>$propertyreleted,
                                                'theme'=>$theme->property_view,
                                                'metatitle'=>$property->metatitle,
                                                'metadescription'=>$property->metadescription,
                                                'metakeyword'=>$property->metakeyword
                                             ]);
                     }else{
                        return redirect()->route('404','404');
                     }

                 }else{
                    return redirect()->route('404','404');
                 }

             }
        }else{
            return redirect()->route('404','404');
        }
    }

    /**property pdf */
    public  function propertypdf($slug) {
        
      $property = Property::where('slug',$slug)->first();
      
       $images = explode(',',$property->photos);
       
         $property->photos = $images; 

      if(!empty($property)){

        
          $pdf = PDF::loadView('pdf',['data'=>$property]);
          return $pdf->download($slug.'.pdf');

          //return  view('pdf',['data'=>$property]); 
      }else{
          return redirect()->route('404','404');
      }
  }

}

   
   
   
   
   
   
   
   
   
   
   
   