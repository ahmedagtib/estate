<div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    
                    <h2 class="ipt-title">{{__('lang.propertylist')}}</h2>
                    <span class="ipn-subtitle">{{__('lang.propertylisttitle')}}</span>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- ============================ Page Title End ================================== -->
    
    <!-- ============================ All Property ================================== -->
   
    <section>
    
        <div class="container">
            <div class="row">
                
                <div class="col-lg-8 col-md-12 list-layout">
                    <div class="row">
                    
                        <div class="col-lg-12 col-md-12">
                            <div class="filter-fl">
                                <h4>{{__('lang.totalpropertyfindis')}}:  <span class="theme-cl">{{$count}}</span></h4>
                                <div>
                                    <select wire:model="order" class="custom-select" style="height: 35px;">
                                       <option value="price">{{__('lang.sortbyprice')}}</option>
                                       <option value="buildon">{{__('lang.sortbybuildon')}}</option>
                                       <option value="latest">{{__('lang.sortbylatest')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                    
                        <!-- Single Property Start -->
                        @if(count($data) > 0)
                        @foreach($data as $property)
                        <div   class="col-lg-12 col-md-12">
                            <div  class="property-listing property-1">
                                    
                                <div class="listing-img-wrapper">
                                    <a href="{{route('property',['slug'=>$property->slug])}}">
                                    @if(!empty($property->thumbnails[0]))
                                    <img src="{{asset($property->thumbnails[0])}}" class="img-fluid mx-auto" alt="{{$property->title}}" title="{{$property->title}}" />
                                    @endif
                                    @if(empty($property->thumbnails[0]))
                                    <img src="{{asset('images/property/default.jpg')}}" class="img-fluid mx-auto" alt="{{$property->title}}"  title="{{$property->title}}"/>
                                    @endif
                                    </a>
                                    <div class="listing-like-top">
                                        <i class="ti-heart"></i>
                                    </div>
                                    <div class="listing-rating">
                                        <span class="text-danger text-bold">  {{ $property->city->city}}</span>
                                    </div>
                                    @if($property->status == 'rent')<span class="property-type">{{__('lang.forrent')}}</span>@endif
                                    @if($property->status == 'sale')<span class="property-type">{{__('lang.forsale')}}</span>@endif
                                </div>
                                
                                <div class="listing-content">
                                
                                    <div class="listing-detail-wrapper">
                                        <div class="listing-short-detail">
                                            <h4 class="listing-name"><a href="{{route('property',['slug'=>$property->slug])}}">{{$property->title}}</a></h4>
                                            <span class="listing-location"><i class="ti-location-pin"></i>{{$property->address}}</span>
                                        </div>
                                    </div>
                                
                                    <div class="listing-features-info">
                                        <ul>
                                         @if($property->propertytype == 'houses' || $property->propertytype == 'apartment' || $property->propertytype == 'villas')    
                                         @if($property->bedrooms)<li><strong>{{__('lang.beds')}}:</strong>{{$property->bedrooms}}</li>@endif
                                         @if($property->bathrooms)<li><strong>{{__('lang.bath')}}:</strong>{{$property->bathrooms}}</li>@endif
                                         @if($property->area)<li><strong>{{__('lang.area')}}:</strong>{{$property->area}}</li>@endif
                                         @else 
                                         @if($property->area)<li><strong>{{__('lang.area')}}:</strong>{{$property->area}}</li>@endif
                                         @endif
                                        </ul>
                                    </div>
                                
                                    <div class="listing-footer-wrapper">
                                        <div class="listing-price">
                                            <h4 class="list-pr">{{config('helper.coin')}} {{$property->price}}</h4>
                                        </div>
                                        <div class="listing-detail-btn">
                                            <a href="{{route('property',['slug'=>$property->slug])}}" class="more-btn">{{__('lang.moreinfo')}}</a>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                        @endforeach

                        <!-- Single Property End -->
                        @else
                        <div class="alert  alert-danger texr-white">
                             Result not found 
                        </div>
                        @endif
                        

                        
					
                        
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
                
                <!-- property Sidebar -->
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div  class="page-sidebar">
                        
                        <!-- Find New Property -->
                        <div   class="sidebar-widgets">
                            
                            <h4>{{__('lang.findnewproperty')}}</h4>
                            
                            <div class="form-group">
                                <select wire:model.defer="type"  class="custom-select">
                                    <option value="houses">    {{__('lang.houses')}}</option>
                                    <option value="apartment"> {{__('lang.apartment')}}</option>
                                    <option value="villas">    {{__('lang.villas')}}</option>
                                    <option value="commercial">{{__('lang.commercial')}}</option>
                                    <option value="offices">   {{__('lang.offices')}}</option>
                                    <option value="garage">    {{__('lang.garage')}}</option>
                                    <option value="ground">    {{__('lang.ground')}}</option>
                                </select>
                                @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <div  wire:model.defer="minprice"  class="input-with-icon">
                                            <input type="text" class="form-control" placeholder="Minimum">
                                            <i>{{config('helper.coin')}}</i>
                                        </div>
                                        @error('minprice') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <input wire:model.defer="maxprice" type="text" class="form-control" placeholder="Maximum">
                                            <i>{{config('helper.coin')}}</i>
                                        </div>
                                        @error('maxprice') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="input-with-icon">
                                    <select wire:model.defer="bedrooms"  class="form-control custom-select">
                                        <option value="">{{__('lang.bedrooms')}}</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <i class="fas fa-bed"></i>
                                </div>
                                @error('bedrooms') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="form-group">
                                <div class="input-with-icon">
                                    <select  wire:model.defer="bathrooms" class="form-control custom-select">
                                        <option value="">{{__('lang.bathrooms')}}</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <i class="fas fa-bath"></i>
                                    @error('bathrooms') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div>
                                    <select  wire:model.defer="status"  class="custom-select">
                                        <option value="rent">{{__('lang.forrent')}}</option>
                                        <option value="sale">{{__('lang.forsale')}}</option>
                                    </select>
                                    @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div>
                                    <select wire:model="stateId" class="custom-select">
                                        @foreach($allstate as $state)
                                        <option value="{{$state->id}}">{{$state->state}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <select wire:model="city_id" class="custom-select">
                                        @foreach($allcities as $city)
                                        <option value="{{$city->id}}">{{$city->city}}</option>
                                        @endforeach
                                    </select>
                                    @error('city_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                    
                            <div class="ameneties-features">
                                <div class="form-group" id="module">
                                    <a role="button" class="" data-toggle="collapse" href="#advance-search" aria-expanded="true" aria-controls="advance-search"></a>
                                </div>
                                <div class="collapse" id="advance-search" aria-expanded="false" role="banner">
                                    <ul class="no-ul-list">
                                        <li>
                                            <input id="a-1" class="checkbox-custom" name="a-1" type="checkbox">
                                            <label for="a-1" class="checkbox-custom-label">Air Condition</label>
                                        </li>
                                        <li>
                                            <input id="a-2" class="checkbox-custom" name="a-2" type="checkbox">
                                            <label for="a-2" class="checkbox-custom-label">Bedding</label>
                                        </li>
                                        <li>
                                            <input id="a-3" class="checkbox-custom" name="a-3" type="checkbox">
                                            <label for="a-3" class="checkbox-custom-label">Heating</label>
                                        </li>
                                        <li>
                                            <input id="a-4" class="checkbox-custom" name="a-4" type="checkbox">
                                            <label for="a-4" class="checkbox-custom-label">Internet</label>
                                        </li>
                                        <li>
                                            <input id="a-5" class="checkbox-custom" name="a-5" type="checkbox">
                                            <label for="a-5" class="checkbox-custom-label">Microwave</label>
                                        </li>
                                        <li>
                                            <input id="a-6" class="checkbox-custom" name="a-6" type="checkbox">
                                            <label for="a-6" class="checkbox-custom-label">Smoking Allow</label>
                                        </li>
                                        <li>
                                            <input id="a-7" class="checkbox-custom" name="a-7" type="checkbox">
                                            <label for="a-7" class="checkbox-custom-label">Terrace</label>
                                        </li>
                                        <li>
                                            <input id="a-8" class="checkbox-custom" name="a-8" type="checkbox">
                                            <label for="a-8" class="checkbox-custom-label">Balcony</label>
                                        </li>
                                        <li>
                                            <input id="a-9" class="checkbox-custom" name="a-9" type="checkbox">
                                            <label for="a-9" class="checkbox-custom-label">Icon</label>
                                        </li>
                                    </ul>
                                </div>
                            
                                <button wire:click="search()" class="btn btn-theme full-width">{{__('lang.findnewhome')}}</button>
                            
                            </div>
                    
                        </div>
                    </div>
                    <!-- Sidebar End -->
                
                </div>
            </div>
        </div>	
    </section>
    @if(Session::has('top'))
<script>
   $('#back2Top').click();
</script>
@endif

</div>


