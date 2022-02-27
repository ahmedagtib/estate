<div class="container">
    <div class="hero-search-wrap">
        <div class="hero-search">
            <h1>Find Your Dream</h1>
        </div>
        <div class="hero-search-content">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <div>
                            <select  wire:model="status"  class="custom-select">
                                <option value="rent">{{__('lang.forrent')}}</option>
                                <option value="sale">{{__('lang.forsale')}}</option>
                            </select>
                        </div>
                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div> 
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <div>
                            <select wire:model="type"  class="custom-select">
                                <option value="houses">    {{__('lang.houses')}}</option>
                                <option value="apartment"> {{__('lang.apartment')}}</option>
                                <option value="villas">    {{__('lang.villas')}}</option>
                                <option value="commercial">{{__('lang.commercial')}}</option>
                                <option value="offices">   {{__('lang.offices')}}</option>
                                <option value="garage">    {{__('lang.garage')}}</option>
                                <option value="ground">    {{__('lang.ground')}}</option>
                            </select>
                        </div>
                        @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div> 
            </div>                
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <div class="input-with-icon">
                            <input wire:model="minprice"  type="text" class="form-control" placeholder="{{__('lang.minimum')}}">
                            <i>€</i>
                        </div>
                        @error('minprice') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <div class="input-with-icon">
                            <input wire:model="maxprice" type="text" class="form-control" placeholder="{{__('lang.maximum')}}">
                            <i>€</i>
                        </div>
                        @error('maxprice') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <div class="input-with-icon">
                            <select wire:model="bedrooms"  class="form-control custom-select">
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
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <div class="input-with-icon">
                            <select  wire:model="bathrooms" class="form-control custom-select">
                                <option value="">{{__('lang.bathrooms')}}</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <i class="fas fa-bath"></i>
                        </div>
                        @error('bathrooms') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <div>
                            <select wire:model="stateId" class="custom-select">
                                @foreach($allstate as $state)
                                <option value="{{$state->id}}">{{$state->state}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <div>
                            <select wire:model="city_id" class="custom-select">
                                @foreach($allcities as $city)
                                <option value="{{$city->id}}">{{$city->city}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('city_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            
        </div>
        <div class="hero-search-action">
            <button wire:click="search()" class="btn search-btn">{{(!empty($button)) ? $button : __('lang.searchresult')}}</button>
        </div>
    </div>
</div>
