@extends('layouts.app')
@section('content')

<div class="image-cover hero-banner"  style="background:url({{asset('img/city.svg')}}) no-repeat;">
    @livewire('component.search-form')
</div>
@if($theme == 1)
@if(!empty($about->hero_title) && !empty($about->hero_content))
<section>
    <div class="container">
        <div class="row align-items-center">
            
            <div class="col-lg-6 col-md-6">
                <img src="{{asset('img/sb.png')}}" class="img-fluid" alt="{{$about->hero_title}}"> 
            </div>
            
            <div class="col-lg-6 col-md-6">
                <div class="explore-content">
                    <h2>{{$about->hero_title}}</h2>
                    <p>{{$about->hero_content}}</p>
                  
                    <a href="{{route('list.properties')}}" class="btn btn-theme-2">{{__('lang.explorebypopular')}}</a>
                </div>
            </div>
            
        </div>
        
    </div>		
</section>    
@endif
@else
<section>
    <div class="container">
        
        <div class="row">
            <div class="col text-center">
                <div class="sec-heading center">
                    <h2>{{__('lang.howitworks')}}</h2>
                    <p>{{__('lang.howtostartworkwithusandworkingprocess')}}</p>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="middle-icon-features">
                    <div class="middle-icon-features-item">
                        <div class="middle-icon-large-features-box"><i class="ti-user text-danger"></i><span class="steps bg-danger">01</span></div>
                        <div class="middle-icon-features-content">
                            <h4>{{__('lang.createanaccount')}}</h4>
                            <p>{{__('lang.createanaccountdesc')}}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-4">
                <div class="middle-icon-features">
                    <div class="middle-icon-features-item">
                        <div class="middle-icon-large-features-box"><i class="ti-search text-success"></i><span class="steps bg-success">02</span></div>
                        <div class="middle-icon-features-content">
                            <h4>{{__('lang.findsearchproperty')}}</h4>
                            <p>{{__('lang.findsearchpropertydesc')}}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-4">
                <div class="middle-icon-features">
                    <div class="middle-icon-features-item">
                        <div class="middle-icon-large-features-box"><i class="ti-location-arrow text-warning"></i><span class="steps bg-warning">03</span></div>
                        <div class="middle-icon-features-content">
                            <h4>{{__('lang.bookyourproperty')}}</h4>
                            <p>{{__('lang.bookyourpropertydesc')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>
<div class="clearfix"></div>
@endif
@if(count($data) > 0)
<section class="gray-bg">
    <div class="container">
    
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h2>{{__('lang.browseallproperty')}}</h2>
            </div>
        </div>
        
        <div class="row">  
            @foreach($data as $item)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="property-listing property-2">
                    
                    <div class="listing-img-wrapper">
                        <div class="list-img-slide">
                            <div class="click">
                                @if(!empty($item->thumbnails[0])  && count($item->thumbnails) > 0)
                                @foreach($item->thumbnails as $photo)
                                @if(!empty($photo))
                                <div>
                                    <a href="{{route('property',$item->slug)}}">
                                       <img src="{{asset($photo)}}" class="img-fluid mx-auto" alt="{{$item->title}}" title="{{$item->title}}"  />
                                   </a>
                                </div>
                                @endif
                                @endforeach
                                @else 
                                <div>
                                    <a href="{{route('property',$item->slug)}}">
                                       <img src="{{asset('images/property/default.jpg')}}" class="img-fluid mx-auto" alt="{{$item->title}}" />
                                   </a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <span class="property-type" style="background: rgba(255,255,255,0.98);">
                            @if($item->status == 'rent') 
                               <span class="text-warning">{{__('lang.forrent')}} </span>  
                             @endif
                            @if($item->status == 'sale') 
                            <span class="text-success"> {{__('lang.forsale')}}  </span>  
                                @endif
                        </span>
                    </div>
                    
                    <div class="listing-detail-wrapper pb-0">
                        <div class="listing-short-detail">
                            <h4 class="listing-name">
                                <i class="list-status ti-check"></i>
                                <a href="{{route('property',$item->slug)}}">{{$item->title}}</a>
                            </h4>
                        </div>
                    </div>
                    
                    <div class="price-features-wrapper">
                        <div class="listing-price-fx">
                            <h6 class="listing-card-info-price ">{{$item->price}} {{config('helper.coin')}}</h6>
                        </div>
                        <div class="list-fx-features">
                            
                            @if($item->propertytype == 'houses' || $item->propertytype == 'apartment' || $item->propertytype == 'villas')
                            <div class="listing-card-info-icon">
                                @if($item->rooms)
                                <span class="inc-fleat inc-bed">{{$item->rooms}} {{__('lang.beds')}}</span>
                                @endif
                            </div>
                            <div class="listing-card-info-icon">
                                @if($item->bathrooms)
                                <span class="inc-fleat inc-bath">{{$item->bathrooms}} {{__('lang.bath')}}</span>
                                @endif
                            </div>
                            @else
                            <div class="listing-card-info-icon">
                                @if($item->area)
                                <span class="inc-fleat inc-area"> {{$item->area}}  {{__('lang.area')}}</span>
                                @endif
                            </div>
                            <div class="listing-card-info-icon">
                                
                            </div>
                            @endif
                        </div>
                    </div>
                    
                </div>
            </div>

            @endforeach               
        </div>
        
    </div>	
</section>
@endif

@if(count($location) > 0)
<section>
    <div class="container">
        
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="sec-heading center">
                    <h2>{{__('lang.findbylocations')}}</h2>
                    <p>{{__('lang.findbylocationsdescription')}}</p>
                </div>
            </div>
        </div>
        
        <div class="row">
        @foreach($location as $key=>$loc)
           @if($key == 1)
            <div class="col-lg-8 col-md-8">
                <a href="{{$loc->url}}" class="img-wrap">
                        <div class="img-wrap-content visible">
                            <h4>{{$loc->cityname}}</h4>
                            <span>{{$loc->numberproperty}} {{__('lang.properties')}}</span>
                        </div>
                    <div class="img-wrap-background" style="background-image: url({{$loc->imagecdn}});"></div>
                </a>	
            </div>
            @else
            
            <div class="col-lg-4 col-md-4">
                <a href="{{$loc->url}}" class="img-wrap">
                        <div class="img-wrap-content visible">
                            <h4>{{$loc->cityname}}</h4>
                            <span>{{$loc->numberproperty}} {{__('lang.properties')}}</span>
                        </div>
                    <div class="img-wrap-background" style="background-image: url({{$loc->imagecdn}});"></div>
                </a>
            </div>
            @endif
         @endforeach              
        </div>
        
    </div>
</section>
@endif

@if(count($blogs) > 0)
<section>
    <div class="container">
    
        <div class="row">
            <div class="col text-center">
                <div class="sec-heading center">
                    <h2>{{__('lang.trendingarticles')}}</h2>
                    <p>{{__('lang.trendingarticlesdescription')}}</p>
                </div>
            </div>
        </div>
        
        <div class="row">
            
          @foreach($blogs as $post)
            <div class="col-lg-4 col-md-6">
                <div class="blog-wrap-grid">
                    
                    <div class="blog-thumb">
                        <a href="{{route('blog',$post->slug)}}">
                            <img src="{{asset($post->photo)}}" class="img-fluid" alt="{{$post->title}}">
                        </a>
                    </div>
                    
                    <div class="blog-info">
                        <span class="post-date"><i class="ti-calendar"></i>{{$post->created_at->diffForHumans()}}</span>
                    </div>
                    
                    <div class="blog-body">
                        <h4 class="bl-title"><a href="blog-detail.html">{{$post->title}}</a></h4>
                        <p>{{Str::limit($post->excerpt,20)}}</p>
                        <a href="{{route('blog',$post->slug)}}" class="bl-continue">{{__('lang.continue')}}</a>
                    </div>
                    
                </div>
            </div>
          @endforeach
        </div>
        
    </div>		
</section>
@endif

@endsection







