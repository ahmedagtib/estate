@extends('layouts.app')
@section('meta')
<meta property="og:url"                content="{{url()->current()}}" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="{{$property->title}}" />
<meta property="og:description"        content="{{$property->title}} - {{Config('app.name')}}" />
<meta property="og:image"              content="{{ asset($property->photos[0])  ??  ''}}" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="{{Config('app.name')}}" />
<meta name="twitter:creator" content="{{Config('app.name')}}" />
<meta property="og:url" content="{{url()->current()}}" />
<meta property="og:title" content="{{$property->title}}" />
<meta property="og:description" content="{{$property->title}} - {{Config('app.name')}}" />
<meta property="og:image" content="{{ asset($property->photos[0])  ??  ''}}" />
<style>
    @media(max-width: 576px) { 
  .property-statement ul li{
      width: 65% !important;
  }    
}

</style>
@endsection
@section('content')
@if($theme == 1)
<div class="featured-slick">
    <div class="featured-slick-slide">
        @if(isset($property->photos)   && count($property->photos) > 0)
        @foreach($property->photos as $photo)
        <div><a href="{{asset($photo)}}" class="mfp-gallery"><img src="{{asset($photo)}}" class="img-fluid mx-auto" alt="{{$property->title}}" /></a></div>
        @endforeach
        @else 
        <div><a href="{{asset('images\property\default.jpg')}}" class="mfp-gallery"><img src="{{asset('images\property\default.jpg')}}" class="img-fluid mx-auto" alt="{{$property->title}}" /></a></div>
        @endif
    </div>
</div>
<section class="spd-wrap">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-12 col-md-12">
                <div class="slide-property-detail">
                    <div class="slide-property-first">
                        <h1 class="title">{{$property->title}}</h1>
                        <div class="pr-price-into">
                            <h2>{{config('helper.coin')}} {{$property->price}} 
                             @if($property->status == 'sale')   <span class="prt-type sale">{{{__('lang.forsale')}}}</span> @endif
                             @if($property->status == 'rent')   <span class="prt-type rent">{{{__('lang.forrent')}}}</span> @endif
                            </h2>
                            <span><i class="lni-map-marker"></i> {{$property->address}}</span>
                        </div>
                        
                    </div>
                    
                    <div class="slide-property-sec">
                        <div class="pr-all-info">
                            
                            <div class="pr-single-info">
                                <div class="share-opt-wrap">
                                    <button type="button" class="btn-share" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-original-title="Share this">
                                        <i class="lni-share"></i>
                                    </button>
                                    <div class="dropdown-menu animated flipInX">
                                        <a  href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}&t={{$property->title}}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="{{__('lang.shareonfacebook')}}"  class="cl-facebook"><i class="lni-facebook"></i></a>
                                        <a href="https://twitter.com/share?url={{url()->current()}}&text={{$property->title}}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="{{__('lang.shareontwitter')}}" class="cl-twitter"><i class="lni-twitter"></i></a>
                                        <a href="whatsapp://send?text={{url()->current()}}" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="{{__('lang.shareonwhatsapp')}}" class="cl-whatsapp"><i class="lni-whatsapp"></i></a>
                                        
                                    </div>
                                </div>

                            </div>
                            
                            <div class="pr-single-info">
                                <a href="{{route('property.pdf',$property->slug)}}" data-toggle="tooltip" data-original-title="Get Print"><i class="ti-printer"></i></a>
                            </div>
                            
                          
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
</section>
<section class="gray">
    <div class="container">
        <div class="row">
            
            <!-- property main detail -->
            <div class="col-lg-8 col-md-12 col-sm-12">
                
                <!-- Single Block Wrap -->
                <div class="block-wrap">
                    
                    <div class="block-header">
                        <h4 class="block-title">{{__('lang.propertyinfo')}}</h4>
                    </div>
                    
                    <div class="block-body">
                        <ul class="dw-proprty-info">
                           @if($property->bedrooms) <li><strong>{{__('lang.bedrooms')}}</strong>{{$property->bedrooms}}</li> @endif
                           @if($property->bathrooms) <li><strong>{{__('lang.bathrooms')}}</strong>{{$property->bathrooms}}</li>@endif
                            @if($property->garage)
                            <li><strong>{{__('lang.garage')}}</strong>{{__('lang.yes')}}</li>
                            @endif
                            <li><strong>{{__('lang.area')}}</strong>{{$property->area}} m²</li>
                            <li><strong>{{__('lang.propertytype')}}</strong>
                               @if($property->propertytype == 'houses')  {{__('lang.houses')}}  @endif
                               @if($property->propertytype == 'apartment')  {{__('lang.apartment')}}  @endif
                               @if($property->propertytype == 'villas')  {{__('lang.villas')}}  @endif
                               @if($property->propertytype == 'commercial')  {{__('lang.commercial')}}  @endif
                               @if($property->propertytype == 'offices')  {{__('lang.offices')}}  @endif
                               @if($property->propertytype == 'garage')  {{__('lang.garage')}}  @endif
                               @if($property->propertytype == 'ground')  {{__('lang.ground')}}  @endif
                                
                            
                            </li>
                            <li><strong>{{__('lang.price')}}</strong>{{config('helper.coin')}} {{$property->price}}</li>

                            
                            <li><strong>{{__('lang.region')}}</strong>
                              <a style="color:#7065ef;" href="{{route('listing.properties',['state'=>$property->city->state->slug])}}">{{$property->city->state->state}}</a>    
                            </li>
                            <li><strong>{{__('lang.city')}}</strong>
                                <a style="color:#7065ef;" href="{{route('listing.properties',['state'=>$property->city->state->slug,'city'=>$property->city->slug])}}">{{$property->city->city}}</a></li>
                            @if($property->buildon)<li><strong>{{__('lang.buildon')}}</strong>
                                {{$property->buildon}}
                            </li>@endif
                            <li><strong>{{__('lang.energyclass')}}</strong>
                                <span class="badge rounded-pill bg-success">{{$property->energy}}</span>
                            </li>
                            <li><strong>{{__('lang.ges')}}</strong>
                                <span class="badge rounded-pill bg-success">{{$property->ges}}</span>
                            </li>
                            <li><strong>{{__('lang.zipcode')}}</strong>{{$property->zipcode}}</li>
                        </ul>
                    </div>
                    
                </div>
                
                <!-- Single Block Wrap -->
                <div class="block-wrap">
                    
                    <div class="block-header">
                        <h4 class="block-title">{{__('lang.description')}}</h4>
                    </div>
                    
                    <div class="block-body">
                        <p>{!! $property->description !!}</p>
                    </div>
                    
                </div>
                
                <!-- Single Block Wrap -->
                <div class="block-wrap">
                    
                    <div class="block-header">
                        <h4 class="block-title">{{__('lang.amenities')}}</h4>
                    </div>
                    
                    <div class="block-body">
                        <ul class="avl-features third">
                        
                             @if($property->features != null && count($property->features) > 0)
                                 @foreach($property->features as $features)
                                   @if($features == 'equippedkitchen')   <li>{{__('lang.equippedkitchen')}}</li> @endif
                                   @if($features == 'americankitchen')   <li>{{__('lang.americankitchen')}}</li> @endif
                                   @if($features == 'separatetoilet')   <li>{{__('lang.separatetoilet')}}</li> @endif
                                   @if($features == 'bathtub')   <li>{{__('lang.bathtub')}}</li> @endif
                                   @if($features == 'fireplace')   <li>{{__('lang.fireplace')}}</li> @endif
                                   @if($features == 'airconditioner')   <li>{{__('lang.airconditioner')}}</li> @endif
                                   @if($features == 'cupboards')   <li>{{__('lang.cupboards')}}</li> @endif
                                   @if($features == 'parquet')   <li>{{__('lang.parquet')}}</li> @endif
                                   @if($features == 'alarm')   <li>{{__('lang.alarm')}}</li> @endif
                                   @if($features == 'attic')   <li>{{__('lang.attic')}}</li> @endif
                                   @if($features == 'balcony')   <li>{{__('lang.balcony')}}</li> @endif
                                   @if($features == 'terrace')   <li>{{__('lang.terrace')}}</li> @endif
                                   @if($features == 'garden')   <li>{{__('lang.garden')}}</li> @endif
                                   @if($features == 'garageparking')   <li>{{__('lang.garageparking')}}</li> @endif
                                   @if($features == 'cellar')   <li>{{__('lang.cellar')}}</li> @endif
                                   @if($features == 'swimmingpool')   <li>{{__('lang.swimmingpool')}}</li> @endif
                                   @if($features == 'tennis')   <li>{{__('lang.tennis')}}</li> @endif
                                   @if($features == 'elevator')   <li>{{__('lang.elevator')}}</li> @endif
                                   @if($features == 'guardian')   <li>{{__('lang.guardian')}}</li> @endif
                                   @if($features == 'digicode')   <li>{{__('lang.digicode')}}</li> @endif
                                   @if($features == 'intercom')   <li>{{__('lang.intercom')}}</li> @endif
                                   @if($features == 'calm')   <li>{{__('lang.calm')}}</li> @endif
                                   @if($features == 'heater')   <li>{{__('lang.heater')}}</li> @endif
                                   @if($features == 'luminous')   <li>{{__('lang.luminous')}}</li> @endif
                                 @endforeach
                             @endif
                        </ul>
                    </div>
                    
                </div>
                                
                
                
            </div>
            
    
            <!-- property Sidebar -->
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="page-sidebar">
                    <!-- Agent Detail -->
                   @livewire('component.mail-property', ['idprop' => $property->id])
                    
                     @if(count($propertyreleted) > 0)
                    <!-- Featured Property -->
                    <div class="sidebar-widgets">
                        
                        <h4>{{__('lang.featuredproperty')}}</h4>
                        
                        <div class="sidebar-property-slide">
                            @foreach($propertyreleted as $item)
                            <div class="single-items">
                                <div class="property-listing property-1">
                        
                                    <div class="listing-img-wrapper">
                                        <a href="{{route('property',$item->slug)}}">
                                            @if(isset($item->thumbnails[0]) && !empty($item->thumbnails[0]))
                                            <img src="{{asset($item->thumbnails[0])}}" class="img-fluid mx-auto" alt="{{$item->title}}" /> 
                                            @else 
                                            <img src="{{asset('images\property\thumbnail\default.jpg')}}" class="img-fluid mx-auto" alt="{{$item->title}}" />    
                                           @endif
                                        </a>
                                        <div class="listing-like-top">
                                            <i class="ti-heart"></i>
                                        </div>
                                        <div class="listing-rating">
                                            <i class="ti-star filled"></i>
                                            <i class="ti-star filled"></i>
                                            <i class="ti-star filled"></i>
                                            <i class="ti-star filled"></i>
                                            <i class="ti-star"></i>
                                        </div>
                                        <span class="property-type">
                                            @if($item->status == 'rent')
                                            {{__('lang.forrent')}}             
                                            @else
                                            {{__('lang.forsale')}}   
                                            @endif
                                        </span>
                                    </div>
                                    
                                    <div class="listing-content">
                                    
                                        <div class="listing-detail-wrapper">
                                            <div class="listing-short-detail">
                                                <h4 class="listing-name"><a href="{{route('property',$item->slug)}}">{{$item->title}}</a></h4>
                                                <span class="listing-location"><i class="ti-location-pin"></i>{{$item->address}}</span>
                                            </div>
                                        </div>
                                    
                                        <div class="listing-features-info">
                                            <ul>
                                               @if($item->bedrooms) <li><strong>{{__('lang.beds')}}:</strong>{{$item->bedrooms}}</li>@endif
                                               @if($item->bathrooms)  <li><strong>{{__('lang.bath')}}:</strong>{{$item->bathrooms}}</li>@endif
                                               @if($item->area) <li><strong>{{__('lang.area')}}:</strong>{{$item->area}}</li>@endif
                                            </ul>
                                        </div>
                                    
                                        <div class="listing-footer-wrapper">
                                            <div class="listing-price">
                                                <h4 class="list-pr">{{config('helper.coin')}} {{$item->price}}</h4>
                                            </div>
                                            <div class="listing-detail-btn">
                                                <a href="{{route('property',$item->slug)}}" class="more-btn">{{__('lang.moreinfo')}}</a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                    </div>
                    @endif
                
                </div>
            </div>
            
        </div>
    </div>
</section>
@endif
@if($theme == 2)
<div class="single-advance-property gray">
    <div class="container-fluid p-0">
        <div class="row align-items-center">
        
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="slider-for">
                    @if(isset($property->photos)   && count($property->photos) > 0)
                    @foreach($property->photos as $photo)
                    <div><a href="{{asset($photo)}}" class="mfp-gallery"><img src="{{asset($photo)}}" class="img-fluid mx-auto" alt="{{$property->title}}" /></a></div>
                    @endforeach
                    @else 
                    <div><a href="{{asset('images\property\default.jpg')}}" class="mfp-gallery"><img src="{{asset('images\property\default.jpg')}}" class="img-fluid mx-auto" alt="{{$property->title}}" /></a></div>
                    @endif
                </div>
                
            </div>
            
            <div class="col-lg-5 col-md-5 col-sm-12">
                <div class="single-advance-caption">
                
                    <div class="property-name-info">
                        <h4 class="property-name">{{$property->title}}</h4>
                        <p class="property-desc">{{$property->address}}</p>
                    </div>
                    
                    <div class="property-price-info">
                        <h4 class="property-price">{{Config('helper.coin')}} {{$property->price}}</h4>
                        <p class="property-sqa">{{$property->area}} <sub>/ m2</sub></p>
                    </div>
                    
                    <div class="property-statement">
                        <ul>
                            <li>
                                <i class="lni-apartment"></i>
                                <div class="ps-trep">
                                    <span>{{__('lang.propertytype')}}</span>
                                    @if($property->propertytype == 'houses') <h5 class="ps-type"> {{__('lang.houses')}} </h5>  @endif
                                    @if($property->propertytype == 'apartment') <h5 class="ps-type"> {{__('lang.apartment')}} </h5> @endif
                                    @if($property->propertytype == 'villas')  <h5 class="ps-type"> {{__('lang.villas')}} </h5> @endif
                                    @if($property->propertytype == 'commercial') <h5 class="ps-type"> {{__('lang.commercial')}} </h5> @endif
                                    @if($property->propertytype == 'offices') <h5 class="ps-type">  {{__('lang.offices')}} </h5> @endif
                                    @if($property->propertytype == 'garage') <h5 class="ps-type">  {{__('lang.garage')}} </h5> @endif
                                    @if($property->propertytype == 'ground') <h5 class="ps-type">  {{__('lang.ground')}} </h5>  @endif
                                </div>
                            </li>
                            @if($property->buildon)
                            <li>
                                <i class="lni-restaurant"></i>
                                <div class="ps-trep">
                                
                                    <span>{{__('lang.buildon')}}</span>
                                    <h5 class="ps-type">{{$property->buildon}}</h5>
                                    
                                </div>
                            </li>
                            @endif
                            <li>
                                <i class="lni lni-map"></i>
                                <div class="ps-trep">
                                    <span>{{__('lang.region')}}</span>
                                    <h5 class="ps-type">
                                       <a style="color:#7065ef;" href="{{route('listing.properties',['state'=>$property->city->state->slug])}}">
                                         {{$property->city->state->state}}
                                       </a> 
                                    </h5>
                                </div>
                            </li>
                            <li>
                                <i class="lni lni-map-marker"></i>
                                <div class="ps-trep">
                                    <span>{{__('lang.city')}}</span>
                                    <h5 class="ps-type">
                                        <a style="color:#7065ef;" href="{{route('listing.properties',['state'=>$property->city->state->slug,'city'=>$property->city->slug])}}">{{$property->city->city}}</a>
                                     </h5>
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </div>
        
        </div>
        
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="slider-nav">
                    @if(isset($property->photos)   && count($property->photos) > 0)
                    @foreach($property->photos as $photo)
                    <div><a href="{{asset($photo)}}" class="mfp-gallery"><img src="{{asset($photo)}}" class="img-fluid mx-auto" alt="{{$property->title}}" /></a></div>
                    @endforeach
                    @else 
                    <div><a href="{{asset('images\property\default.jpg')}}" class="mfp-gallery"><img src="{{asset('images\property\default.jpg')}}" class="img-fluid mx-auto" alt="{{$property->title}}" /></a></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<section class="spd-wrap">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-12 col-md-12">
            
                <div class="slide-property-detail">
                    
                    <div class="slide-property-first">
                        <div class="pr-price-into">
                            @if($property->status == 'sale') <h2>{{Config('helper.coin')}} {{$property->price}}<i>/ </i> <span class="prt-type sale">{{{__('lang.forsale')}}}</span></h2>@endif
                            @if($property->status == 'rent') <h2>{{Config('helper.coin')}} {{$property->price}}<i>/ </i> <span class="prt-type sale">{{{__('lang.forrent')}}}</span></h2>@endif
                            <span><i class="lni-map-marker"></i> {{$property->address}}</span>
                        </div>
                    </div>
                    
                    <div class="slide-property-sec">
                        <div class="pr-all-info">
                            
                            <div class="pr-single-info">
                                <div class="share-opt-wrap">
                                    <button type="button" class="btn-share" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-original-title="Share this">
                                        <i class="lni-share"></i>
                                    </button>
                                    <div class="dropdown-menu animated flipInX">
                                        <a  href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}&t={{$property->title}}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="{{__('lang.shareonfacebook')}}"  class="cl-facebook"><i class="lni-facebook"></i></a>
                                        <a href="https://twitter.com/share?url={{url()->current()}}&text={{$property->title}}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="{{__('lang.shareontwitter')}}" class="cl-twitter"><i class="lni-twitter"></i></a>
                                        <a href="whatsapp://send?text={{url()->current()}}" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="{{__('lang.shareonwhatsapp')}}" class="cl-whatsapp"><i class="lni-whatsapp"></i></a>
                                        
                                    </div>
                                </div>

                            </div>
                            
                            <div class="pr-single-info">
                                <a href="{{route('property.pdf',$property->slug)}}" data-toggle="tooltip" data-original-title="Get Print"><i class="ti-printer"></i></a>
                            </div>
                            
                          
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
</section>
<section class="gray">
    <div class="container">
        <div class="row">
            
            <!-- property main detail -->
            <div class="col-lg-8 col-md-12 col-sm-12">
                
                <!-- Single Block Wrap -->
                <div class="block-wrap">
                    
                    <div class="block-header">
                        <h4 class="block-title">{{__('lang.propertyinfo')}}</h4>
                    </div>
                    
                    <div class="block-body">
                        <ul class="dw-proprty-info">
                           @if($property->bedrooms) <li><strong>{{__('lang.bedrooms')}}</strong>{{$property->bedrooms}}</li> @endif
                           @if($property->bathrooms) <li><strong>{{__('lang.bathrooms')}}</strong>{{$property->bathrooms}}</li>@endif
                            @if($property->garage)
                            <li><strong>{{__('lang.garage')}}</strong>{{__('lang.yes')}}</li>
                            @endif
                            <li><strong>{{__('lang.area')}}</strong>{{$property->area}} m²</li>
                            <li><strong>{{__('lang.propertytype')}}</strong>
                               @if($property->propertytype == 'houses')  {{__('lang.houses')}}  @endif
                               @if($property->propertytype == 'apartment')  {{__('lang.apartment')}}  @endif
                               @if($property->propertytype == 'villas')  {{__('lang.villas')}}  @endif
                               @if($property->propertytype == 'commercial')  {{__('lang.commercial')}}  @endif
                               @if($property->propertytype == 'offices')  {{__('lang.offices')}}  @endif
                               @if($property->propertytype == 'garage')  {{__('lang.garage')}}  @endif
                               @if($property->propertytype == 'ground')  {{__('lang.ground')}}  @endif
                                
                            
                            </li>
                            <li><strong>{{__('lang.price')}}</strong>{{config('helper.coin')}} {{$property->price}}</li>

                            
                            <li><strong>{{__('lang.region')}}</strong>
                              <a style="color:#7065ef;" href="{{route('listing.properties',['state'=>$property->city->state->slug])}}">{{$property->city->state->state}}</a>    
                            </li>
                            <li><strong>{{__('lang.city')}}</strong>
                                <a style="color:#7065ef;" href="{{route('listing.properties',['state'=>$property->city->state->slug,'city'=>$property->city->slug])}}">{{$property->city->city}}</a></li>
                            @if($property->buildon)<li><strong>{{__('lang.buildon')}}</strong>
                                {{$property->buildon}}
                            </li>@endif
                            <li><strong>{{__('lang.energyclass')}}</strong>
                                <span class="badge rounded-pill bg-success">{{$property->energy}}</span>
                            </li>
                            <li><strong>{{__('lang.ges')}}</strong>
                                <span class="badge rounded-pill bg-success">{{$property->ges}}</span>
                            </li>
                            <li><strong>{{__('lang.zipcode')}}</strong>{{$property->zipcode}}</li>
                        </ul>
                    </div>
                    
                </div>
                
                <!-- Single Block Wrap -->
                <div class="block-wrap">
                    
                    <div class="block-header">
                        <h4 class="block-title">{{__('lang.description')}}</h4>
                    </div>
                    
                    <div class="block-body">
                        <p>{!! $property->description !!}</p>
                    </div>
                    
                </div>
                
                <!-- Single Block Wrap -->
                <div class="block-wrap">
                    
                    <div class="block-header">
                        <h4 class="block-title">{{__('lang.amenities')}}</h4>
                    </div>
                    
                    <div class="block-body">
                        <ul class="avl-features third">
                        
                             @if($property->features != null && count($property->features) > 0)
                                 @foreach($property->features as $features)
                                   @if($features == 'equippedkitchen')   <li>{{__('lang.equippedkitchen')}}</li> @endif
                                   @if($features == 'americankitchen')   <li>{{__('lang.americankitchen')}}</li> @endif
                                   @if($features == 'separatetoilet')   <li>{{__('lang.separatetoilet')}}</li> @endif
                                   @if($features == 'bathtub')   <li>{{__('lang.bathtub')}}</li> @endif
                                   @if($features == 'fireplace')   <li>{{__('lang.fireplace')}}</li> @endif
                                   @if($features == 'airconditioner')   <li>{{__('lang.airconditioner')}}</li> @endif
                                   @if($features == 'cupboards')   <li>{{__('lang.cupboards')}}</li> @endif
                                   @if($features == 'parquet')   <li>{{__('lang.parquet')}}</li> @endif
                                   @if($features == 'alarm')   <li>{{__('lang.alarm')}}</li> @endif
                                   @if($features == 'attic')   <li>{{__('lang.attic')}}</li> @endif
                                   @if($features == 'balcony')   <li>{{__('lang.balcony')}}</li> @endif
                                   @if($features == 'terrace')   <li>{{__('lang.terrace')}}</li> @endif
                                   @if($features == 'garden')   <li>{{__('lang.garden')}}</li> @endif
                                   @if($features == 'garageparking')   <li>{{__('lang.garageparking')}}</li> @endif
                                   @if($features == 'cellar')   <li>{{__('lang.cellar')}}</li> @endif
                                   @if($features == 'swimmingpool')   <li>{{__('lang.swimmingpool')}}</li> @endif
                                   @if($features == 'tennis')   <li>{{__('lang.tennis')}}</li> @endif
                                   @if($features == 'elevator')   <li>{{__('lang.elevator')}}</li> @endif
                                   @if($features == 'guardian')   <li>{{__('lang.guardian')}}</li> @endif
                                   @if($features == 'digicode')   <li>{{__('lang.digicode')}}</li> @endif
                                   @if($features == 'intercom')   <li>{{__('lang.intercom')}}</li> @endif
                                   @if($features == 'calm')   <li>{{__('lang.calm')}}</li> @endif
                                   @if($features == 'heater')   <li>{{__('lang.heater')}}</li> @endif
                                   @if($features == 'luminous')   <li>{{__('lang.luminous')}}</li> @endif
                                 @endforeach
                             @endif
                        </ul>
                    </div>
                    
                </div>
                                
                
                
            </div>
            
    
            <!-- property Sidebar -->
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="page-sidebar">
                    <!-- Agent Detail -->
                   @livewire('component.mail-property', ['idprop' => $property->id])
                    
                     @if(count($propertyreleted) > 0)
                    <!-- Featured Property -->
                    <div class="sidebar-widgets">
                        
                        <h4>{{__('lang.featuredproperty')}}</h4>
                        
                        <div class="sidebar-property-slide">
                            @foreach($propertyreleted as $item)
                            <div class="single-items">
                                <div class="property-listing property-1">
                        
                                    <div class="listing-img-wrapper">
                                        <a href="{{route('property',$item->slug)}}">
                                            @if(isset($item->thumbnails[0]) && !empty($item->thumbnails[0]))
                                             <img src="{{asset($item->thumbnails[0])}}" class="img-fluid mx-auto" alt="{{$item->title}}" /> 
                                             @else 
                                             <img src="{{asset('images\property\thumbnail\default.jpg')}}" class="img-fluid mx-auto" alt="{{$item->title}}" />    
                                            @endif
                                            
                                        </a>
                                        <div class="listing-like-top">
                                            <i class="ti-heart"></i>
                                        </div>
                                        <div class="listing-rating">
                                            <i class="ti-star filled"></i>
                                            <i class="ti-star filled"></i>
                                            <i class="ti-star filled"></i>
                                            <i class="ti-star filled"></i>
                                            <i class="ti-star"></i>
                                        </div>
                                        <span class="property-type">
                                            @if($item->status == 'rent')
                                            {{__('lang.forrent')}}             
                                            @else
                                            {{__('lang.forsale')}}   
                                            @endif
                                        </span>
                                    </div>
                                    
                                    <div class="listing-content">
                                    
                                        <div class="listing-detail-wrapper">
                                            <div class="listing-short-detail">
                                                <h4 class="listing-name"><a href="{{route('property',$item->slug)}}">{{$item->title}}</a></h4>
                                                <span class="listing-location"><i class="ti-location-pin"></i>{{$item->address}}</span>
                                            </div>
                                        </div>
                                    
                                        <div class="listing-features-info">
                                            <ul>
                                               @if($item->bedrooms) <li><strong>{{__('lang.beds')}}:</strong>{{$item->bedrooms}}</li>@endif
                                               @if($item->bathrooms)  <li><strong>{{__('lang.bath')}}:</strong>{{$item->bathrooms}}</li>@endif
                                               @if($item->area) <li><strong>{{__('lang.area')}}:</strong>{{$item->area}}</li>@endif
                                            </ul>
                                        </div>
                                    
                                        <div class="listing-footer-wrapper">
                                            <div class="listing-price">
                                                <h4 class="list-pr">{{config('helper.coin')}} {{$item->price}}</h4>
                                            </div>
                                            <div class="listing-detail-btn">
                                                <a href="{{route('property',$item->slug)}}" class="more-btn">{{__('lang.moreinfo')}}</a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                    </div>
                    @endif

                    
                
                </div>
            </div>
            
        </div>
    </div>
</section>
@endif
@if($theme == 3)
<section class="gray">
    <div class="container">
        <div class="row">
            
            <!-- property main detail -->
            <div class="col-lg-8 col-md-12 col-sm-12">
                <h1 style="font-size:2em;">{{$property->title}}</h1>
                <div class="slide-property-first mb-4">
                    <div class="pr-price-into">
                        <h2>{{config('helper.coin')}} {{$property->price}} 
                            @if($property->status == 'sale')   <span class="prt-type sale">{{{__('lang.forsale')}}}</span> @endif
                            @if($property->status == 'rent')   <span class="prt-type rent">{{{__('lang.forrent')}}}</span> @endif
                        </h2>
                        <span><i class="lni-map-marker"></i> {{$property->address}}</span>
                    </div>
                </div>
                    
                <div class="property3-slide single-advance-property mb-4">
            
                    <div class="slider-for">
                        @if(isset($property->photos)   && count($property->photos) > 0)
                        @foreach($property->photos as $photo)
                        <div><a href="{{asset($photo)}}" class="mfp-gallery"><img src="{{asset($photo)}}" class="img-fluid mx-auto" alt="{{$property->title}}" /></a></div>
                        @endforeach
                        @else 
                        <div><a href="{{asset('images\property\default.jpg')}}" class="mfp-gallery"><img src="{{asset('images\property\default.jpg')}}" class="img-fluid mx-auto" alt="{{$property->title}}" /></a></div>
                        @endif
                    </div>
                    <div class="slider-nav">
                        @if(isset($property->photos)   && count($property->photos) > 0)
                        @foreach($property->photos as $photo)
                        <div class="item-slick"><img src="{{asset($photo)}}" alt="{{$property->title}}"></div>
                        @endforeach
                        @else 
                        <div class="item-slick"><img src="{{asset('images\property\default.jpg')}}" alt="{{$property->title}}" title="{{$property->title}}"></div>
                        @endif
                    </div>
                    
                </div>
                
                <div class="block-wrap">
                    
                    <div class="block-header">
                        <h4 class="block-title">{{__('lang.propertyinfo')}}</h4>
                    </div>
                    
                    <div class="block-body">
                        <ul class="dw-proprty-info">
                           @if($property->bedrooms) <li><strong>{{__('lang.bedrooms')}}</strong>{{$property->bedrooms}}</li> @endif
                           @if($property->bathrooms) <li><strong>{{__('lang.bathrooms')}}</strong>{{$property->bathrooms}}</li>@endif
                            @if($property->garage)
                            <li><strong>{{__('lang.garage')}}</strong>{{__('lang.yes')}}</li>
                            @endif
                            <li><strong>{{__('lang.area')}}</strong>{{$property->area}} m²</li>
                            <li><strong>{{__('lang.propertytype')}}</strong>
                               @if($property->propertytype == 'houses')  {{__('lang.houses')}}  @endif
                               @if($property->propertytype == 'apartment')  {{__('lang.apartment')}}  @endif
                               @if($property->propertytype == 'villas')  {{__('lang.villas')}}  @endif
                               @if($property->propertytype == 'commercial')  {{__('lang.commercial')}}  @endif
                               @if($property->propertytype == 'offices')  {{__('lang.offices')}}  @endif
                               @if($property->propertytype == 'garage')  {{__('lang.garage')}}  @endif
                               @if($property->propertytype == 'ground')  {{__('lang.ground')}}  @endif
                                
                            
                            </li>
                            <li><strong>{{__('lang.price')}}</strong>{{config('helper.coin')}} {{$property->price}}</li>

                            
                            <li><strong>{{__('lang.region')}}</strong>
                              <a style="color:#7065ef;" href="{{route('listing.properties',['state'=>$property->city->state->slug])}}">{{$property->city->state->state}}</a>    
                            </li>
                            <li><strong>{{__('lang.city')}}</strong>
                                <a style="color:#7065ef;" href="{{route('listing.properties',['state'=>$property->city->state->slug,'city'=>$property->city->slug])}}">{{$property->city->city}}</a></li>
                            @if($property->buildon)<li><strong>{{__('lang.buildon')}}</strong>
                                {{$property->buildon}}
                            </li>@endif
                            <li><strong>{{__('lang.energyclass')}}</strong>
                                <span class="badge rounded-pill bg-success">{{$property->energy}}</span>
                            </li>
                            <li><strong>{{__('lang.ges')}}</strong>
                                <span class="badge rounded-pill bg-success">{{$property->ges}}</span>
                            </li>
                            <li><strong>{{__('lang.zipcode')}}</strong>{{$property->zipcode}}</li>
                        </ul>
                    </div>
                    
                </div>
                
                <!-- Single Block Wrap -->
                <div class="block-wrap">
                    
                    <div class="block-header">
                        <h4 class="block-title">{{__('lang.description')}}</h4>
                    </div>
                    
                    <div class="block-body">
                        <p>{!! $property->description !!}</p>
                    </div>
                    
                </div>
                
                <!-- Single Block Wrap -->
                <div class="block-wrap">
                    
                    <div class="block-header">
                        <h4 class="block-title">{{__('lang.amenities')}}</h4>
                    </div>
                    
                    <div class="block-body">
                        <ul class="avl-features third">
                        
                             @if($property->features != null && count($property->features) > 0)
                                 @foreach($property->features as $features)
                                   @if($features == 'equippedkitchen')   <li>{{__('lang.equippedkitchen')}}</li> @endif
                                   @if($features == 'americankitchen')   <li>{{__('lang.americankitchen')}}</li> @endif
                                   @if($features == 'separatetoilet')   <li>{{__('lang.separatetoilet')}}</li> @endif
                                   @if($features == 'bathtub')   <li>{{__('lang.bathtub')}}</li> @endif
                                   @if($features == 'fireplace')   <li>{{__('lang.fireplace')}}</li> @endif
                                   @if($features == 'airconditioner')   <li>{{__('lang.airconditioner')}}</li> @endif
                                   @if($features == 'cupboards')   <li>{{__('lang.cupboards')}}</li> @endif
                                   @if($features == 'parquet')   <li>{{__('lang.parquet')}}</li> @endif
                                   @if($features == 'alarm')   <li>{{__('lang.alarm')}}</li> @endif
                                   @if($features == 'attic')   <li>{{__('lang.attic')}}</li> @endif
                                   @if($features == 'balcony')   <li>{{__('lang.balcony')}}</li> @endif
                                   @if($features == 'terrace')   <li>{{__('lang.terrace')}}</li> @endif
                                   @if($features == 'garden')   <li>{{__('lang.garden')}}</li> @endif
                                   @if($features == 'garageparking')   <li>{{__('lang.garageparking')}}</li> @endif
                                   @if($features == 'cellar')   <li>{{__('lang.cellar')}}</li> @endif
                                   @if($features == 'swimmingpool')   <li>{{__('lang.swimmingpool')}}</li> @endif
                                   @if($features == 'tennis')   <li>{{__('lang.tennis')}}</li> @endif
                                   @if($features == 'elevator')   <li>{{__('lang.elevator')}}</li> @endif
                                   @if($features == 'guardian')   <li>{{__('lang.guardian')}}</li> @endif
                                   @if($features == 'digicode')   <li>{{__('lang.digicode')}}</li> @endif
                                   @if($features == 'intercom')   <li>{{__('lang.intercom')}}</li> @endif
                                   @if($features == 'calm')   <li>{{__('lang.calm')}}</li> @endif
                                   @if($features == 'heater')   <li>{{__('lang.heater')}}</li> @endif
                                   @if($features == 'luminous')   <li>{{__('lang.luminous')}}</li> @endif
                                 @endforeach
                             @endif
                        </ul>
                    </div>
                    
                </div>                
            </div>
            
            <!-- property Sidebar -->
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="page-sidebar">
                    
                    <!-- slide-property-sec -->
                    <div class="slide-property-sec mb-4">
                        <div class="pr-all-info">
                            
                            <div class="pr-single-info">
                                <div class="share-opt-wrap">
                                    <button type="button" class="btn-share" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-original-title="Share this">
                                        <i class="lni-share"></i>
                                    </button>
                                    <div class="dropdown-menu animated flipInX">
                                        <a  href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}&t={{$property->title}}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="{{__('lang.shareonfacebook')}}"  class="cl-facebook"><i class="lni-facebook"></i></a>
                                        <a href="https://twitter.com/share?url={{url()->current()}}&text={{$property->title}}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="{{__('lang.shareontwitter')}}" class="cl-twitter"><i class="lni-twitter"></i></a>
                                        <a href="whatsapp://send?text={{url()->current()}}" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="{{__('lang.shareonwhatsapp')}}" class="cl-whatsapp"><i class="lni-whatsapp"></i></a>
                                        
                                    </div>
                                </div>

                            </div>
                            
                            <div class="pr-single-info">
                                <a href="{{route('property.pdf',$property->slug)}}" data-toggle="tooltip" data-original-title="Get Print"><i class="ti-printer"></i></a>
                            </div>
                            
                          
                        </div>
                    </div>
                    
                    <!-- Agent Detail -->
                    @livewire('component.mail-property', ['idprop' => $property->id])
                    
                    @if(count($propertyreleted) > 0)
                    <!-- Featured Property -->
                    <div class="sidebar-widgets">
                        
                        <h4>{{__('lang.featuredproperty')}}</h4>
                        
                        <div class="sidebar-property-slide">
                            @foreach($propertyreleted as $item)
                            <div class="single-items">
                                <div class="property-listing property-1">
                        
                                    <div class="listing-img-wrapper">
                                        <a href="{{route('property',$item->slug)}}">
                                            @if(isset($item->thumbnails[0]) && !empty($item->thumbnails[0]))
                                            <img src="{{asset($item->thumbnails[0])}}" class="img-fluid mx-auto" alt="{{$item->title}}" /> 
                                            @else 
                                            <img src="{{asset('images\property\thumbnail\default.jpg')}}" class="img-fluid mx-auto" alt="{{$item->title}}" />    
                                           @endif
                                        </a>
                                        <div class="listing-like-top">
                                            <i class="ti-heart"></i>
                                        </div>
                                        <div class="listing-rating">
                                            <i class="ti-star filled"></i>
                                            <i class="ti-star filled"></i>
                                            <i class="ti-star filled"></i>
                                            <i class="ti-star filled"></i>
                                            <i class="ti-star"></i>
                                        </div>
                                        <span class="property-type">
                                            @if($item->status == 'rent')
                                            {{__('lang.forrent')}}             
                                            @else
                                            {{__('lang.forsale')}}   
                                            @endif
                                        </span>
                                    </div>
                                    
                                    <div class="listing-content">
                                    
                                        <div class="listing-detail-wrapper">
                                            <div class="listing-short-detail">
                                                <h4 class="listing-name"><a href="{{route('property',$item->slug)}}">{{$item->title}}</a></h4>
                                                <span class="listing-location"><i class="ti-location-pin"></i>{{$item->address}}</span>
                                            </div>
                                        </div>
                                    
                                        <div class="listing-features-info">
                                            <ul>
                                               @if($item->bedrooms) <li><strong>{{__('lang.beds')}}:</strong>{{$item->bedrooms}}</li>@endif
                                               @if($item->bathrooms)  <li><strong>{{__('lang.bath')}}:</strong>{{$item->bathrooms}}</li>@endif
                                               @if($item->area) <li><strong>{{__('lang.area')}}:</strong>{{$item->area}}</li>@endif
                                            </ul>
                                        </div>
                                    
                                        <div class="listing-footer-wrapper">
                                            <div class="listing-price">
                                                <h4 class="list-pr">{{config('helper.coin')}} {{$item->price}}</h4>
                                            </div>
                                            <div class="listing-detail-btn">
                                                <a href="{{route('property',$item->slug)}}" class="more-btn">{{__('lang.moreinfo')}}</a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                    </div>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
    
</section>
@endif
@endsection
