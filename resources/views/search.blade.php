@extends('layouts.app')
@section('content')
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                
                <h2 class="ipt-title">{{$title}}</h2> 
            </div>
        </div>
    </div>
</div>
<section>
    <div class="container">
    
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h4>{{__('lang.totalpropertyfindis')}}: <span class="theme-cl">{{$count}}</span></h4>
            </div>
        </div>
    
        <div class="row">
          @foreach($data as $property)       
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="property-listing property-2">
                    <div class="listing-img-wrapper">
                        <div class="list-img-slide">
                            <div class="click">
                                @foreach($property->thumbnails as $photo)
                                @if(!empty($photo))
                                <div>
                                    <a  href="{{route('property',['slug'=>$property->slug])}}">
                                        <img  src="{{asset($photo)}}" class="img-fluid mx-auto" alt="{{$property->title}}" title="{{$property->title}}" />
                                    </a>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <span class="property-type">
                           @if($property->status == 'rent') {{__('lang.forrent')}} @endif
                           @if($property->status == 'sale') {{__('lang.forsale')}} @endif
                        </span>
                    </div>
                    
                    <div class="listing-detail-wrapper pb-0">
                        <div class="listing-short-detail">
                            <h4 class="listing-name">
                                <a href="{{route('property',['slug'=>$property->slug])}}">{{$property->title}}</a>
                                <i class="list-status ti-check"></i></h4>
                        </div>
                    </div>
                    
                    <div class="price-features-wrapper">
                        <div class="listing-price-fx">
                            <h6 class="listing-card-info-price">{{$property->price}}<span>{{config('helper.coin')}}</span></h6>
                        </div>
                        <div class="list-fx-features">
                            @if($property->propertytype == 'houses' || $property->propertytype == 'apartment' || $property->propertytype == 'villas')
                            <div class="listing-card-info-icon">
                                @if($property->bedrooms)
                                <span class="inc-fleat inc-bed">{{$property->bedrooms}} {{__('lang.beds')}}</span>
                                @endif
                            </div>
                            <div class="listing-card-info-icon">
                                @if($property->bathrooms)
                                <span class="inc-fleat inc-bath">{{$property->bathrooms}}  {{__('lang.bath')}}</span>
                                @endif
                            </div>
                            @else 
                            <div class="listing-card-info-icon">
                                @if($property->area)
                                <span class="inc-fleat inc-area">{{$property->area}}  {{__('lang.area')}}</span>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                    
                </div>
            </div>
          @endforeach          
        </div>
        
        <!-- Pagination -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <ul class="pagination p-center">
                    {{ $data->links() }}
                     
                </ul>
            </div>
        </div>
        
    </div>		
</section>
@endsection