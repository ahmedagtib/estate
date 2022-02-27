<div>
    <div id="titleid" class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    
                    <h2 class="ipt-title">{{__('lang.createadfree')}}</h2>
                    <span class="ipn-subtitle">{{__('lang.createadtitle')}}</span>
                </div>
            </div>
        </div>
    </div>

    <section>
			
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="submit-page bg-white">
                        @if($current_step == 1) <h3>{{__('lang.letsstartwiththebasics')}}</h3> @endif
                        @if($current_step == 2) <h3>{{__('lang.tellusmore')}}</h3> @endif
                        @if($current_step == 3) <h3>{{__('lang.describeyourproperty')}}</h3> @endif
                        @if($current_step == 4) <h3>{{__('lang.addphotos')}}</h3> @endif
                        @if($current_step == 5) <h3>{{__('lang.yourcontactdetails')}}</h3> @endif
                        <div class="progress">
                            <div class="progress-bar bg-primary  progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{$percentage}}%;" aria-valuenow="{{$percentage}}" aria-valuemin="0" aria-valuemax="100">{{$percentage}}%</div>
                          </div>
                            <div class="form-submit" >	
                                <div class="submit-section">
                                    <div class="form-row">
                                        @if($current_step == 1)
                                        <div class="form-group col-md-12">
                                            <label>{{__('lang.propertytitle')}}<a href="#" class="tip-topdata" data-tip="{{__('lang.propertytitleinfo')}}"><i class="ti-help"></i></a></label>
                                            <input wire:model="title" type="text" class="form-control">
                                            @error('title') <span class="mt-1 text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group col-md-6" >
                                            <label>{{__('lang.choosepropertyregion')}}</label>
                                            <select wire:model="stateId"  class="bg-secondary  custom-select custom-select-lg" >
                                                @foreach($allstate as $state)
                                                   <option value="{{$state->id}}">{{$state->state}}</option>
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                        @if(count($allcities) > 0)
                                        <div  class="form-group col-md-6">
                                            <label>{{__('lang.choosepropertycity')}}</label>
                                            <select wire:model="city_id"  class="bg-secondary  custom-select custom-select-lg" title="Choose city..."  >
                                                @foreach($allcities as $city)
                                                <option value="{{ $city->id }}" >{{ $city->city }}</option>
                                                @endforeach
                                            </select>
                                            @error('city_id') <span class="mt-1 text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        @endif
                                        
                                        <div class="form-group col-md-6">
                                            <label>{{__('lang.propertyfor')}}</label>
                                            <select wire:model="status" class="bg-secondary  custom-select custom-select-lg">
                                                <option value="sale">{{__('lang.sale')}}</option>
                                                <option value="rent">{{__('lang.rent')}}</option>
                                            </select>
                                            @error('status') <span class="mt-1 text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>{{__('lang.price')}}</label>
                                            <input wire:model="price" type="text" class="form-control" placeholder="{{config('helper.coin')}}">
                                            @error('price') <span class="mt-1 text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>{{__('lang.propertytype')}}</label>
                                              <div class="row">
                                                    <div  class="col-md-2">
                                                       <label for="houses"  class="{{ ($propertyType == 'houses') ? 'mt-2 card rounded bg-primary text-white' : 'mt-2 card rounded' }}">
                                                            <div class="card-body text-center">
                                                                <p class="mt-2">
                                                                    <svg width="40" height="40" xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                                                      </svg>
                                                                    <div class="h6">
                                                                        {{__('lang.houses')}}
                                                                    </div>  
                                                                </p>
                                                            </div>
                                                       </label>
                                                       <input id="houses" name="propertyType" wire:model="propertyType" style="display: none;" type="radio" value="houses"/>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="apartment"  class="{{ ($propertyType == 'apartment') ? 'mt-2 card rounded bg-primary text-white' : 'mt-2 card rounded' }}">
                                                             <div class="card-body text-center">
                                                                 <p class="mt-2">
                                                                      <svg  width="40" height="40" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                                      </svg>
                                                                     <div class="h6">
                                                                        {{__('lang.apartment')}}
                                                                     </div>  
                                                                 </p>
                                                             </div>
                                                        </label>
                                                        <input id="apartment" name="propertyType"  wire:model="propertyType" style="display: none;" type="radio" value="apartment"/>
                                                     </div>
                                                     <div class="col-md-2">
                                                        <label for="villas" class="{{ ($propertyType == 'villas') ? 'mt-2 card rounded bg-primary text-white' : 'mt-2 card rounded' }}">
                                                             <div class="card-body text-center">
                                                                 <p class="mt-2">
                                                                    <svg width="40" height="40" xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                                                      </svg>
                                                                     <div class="h6">
                                                                         {{__('lang.villas')}}
                                                                     </div>  
                                                                 </p>
                                                             </div>
                                                        </label>
                                                        <input id="villas" name="propertyType" wire:model="propertyType" style="display: none;" type="radio" value="villas"/>
                                                     </div>
                                                     <div class="col-md-2">
                                                        <label for="commercial" class="{{ ($propertyType == 'commercial') ? 'mt-2 card rounded bg-primary text-white' : 'mt-2 card rounded' }}">
                                                             <div class="card-body text-center">
                                                                 <p class="mt-2">
                                                                    <svg width="40" height="40"   xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                                      </svg>
                                                                     <div class="h6">
                                                                         {{__('lang.commercial')}}
                                                                     </div>  
                                                                 </p>
                                                             </div>
                                                        </label>
                                                        <input id="commercial" name="propertyType" wire:model="propertyType" style="display: none;" type="radio" value="commercial"/>
                                                     </div>
                                                     <div class="col-md-2">
                                                        <label for="offices" class="{{ ($propertyType == 'offices') ? 'mt-2 card rounded bg-primary text-white' : 'mt-2 card rounded' }}">
                                                             <div class="card-body text-center">
                                                                 <p class="mt-2">
                                                                    <svg  width="40" height="40"   xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 20 20" fill="currentColor">
                                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" />
                                                                      </svg>
                                                                     <div class="h6">
                                                                         {{__('lang.offices')}}
                                                                     </div>  
                                                                 </p>
                                                             </div>
                                                        </label>
                                                        <input id="offices" name="propertyType" wire:model="propertyType" style="display: none;" type="radio" value="offices"/>
                                                     </div>
                                                     <div class="col-md-2">
                                                        <label for="garage" class="{{ ($propertyType == 'garage') ? 'mt-2 card rounded bg-primary text-white' : 'mt-2 card rounded' }}">
                                                             <div class="card-body text-center">
                                                                 <p class="mt-2">
                                                                    <svg  width="40" height="40" xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                                                      </svg>
                                                                     <div class="h6">
                                                                         {{__('lang.garage')}}
                                                                     </div>  
                                                                 </p>
                                                             </div>
                                                        </label>
                                                        <input id="garage" name="propertyType" wire:model="propertyType" style="display: none;" type="radio" value="garage"/>
                                                     </div>
                                                     <div class="col-md-2">
                                                        <label for="ground" class="{{ ($propertyType == 'ground') ? 'mt-2 card rounded bg-primary text-white' : 'mt-2 card rounded' }}">
                                                             <div class="card-body text-center">
                                                                 <p class="mt-2">
                                                                    <svg width="40" height="40" xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                                                      </svg>
                                                                     <div class="h6">
                                                                          {{__('lang.ground')}}
                                                                     </div>  
                                                                 </p>
                                                             </div>
                                                        </label>
                                                        <input id="ground" name="propertyType" wire:model="propertyType" style="display: none;" type="radio" value="ground"/>
                                                     </div>
                                                     @error('propertyType') <span class="mt-1 text-danger">{{ $message }}</span> @enderror
                                              </div>
                                        </div>
                                        @endif
                                        @if($current_step == 2)
                                        <div class="col-md-6">
                                            <label>{{__('lang.energyclass')}}</label>
                                            <div>
                                                <label for="a_e" class="{{($energy != 'a') ? 'mr-1 border border-secondary rounded py-1 px-2':'mr-1  bg-primary text-white rounded py-1 px-2'}}" style="cursor:pointer ;">
                                                    <p class="font-weight-bold h4">A</p>
                                                    <input id="a_e" wire:model="energy" style="display: none;" type="radio" value="a" />
                                                </label>
                                                <label for="b_e"  class="{{($energy != 'b') ? 'mr-1 border border-secondary rounded py-1 px-2':'mr-1  bg-primary text-white rounded py-1 px-2'}}" style="cursor:pointer ;">
                                                    <p class="font-weight-bold h4">B</p>
                                                    <input id="b_e" wire:model="energy" style="display: none;" type="radio" value="b" />
                                                </label>
                                                <label for="c_e"  class="{{($energy != 'c') ? 'mr-1 border border-secondary rounded py-1 px-2':'mr-1  bg-primary text-white rounded py-1 px-2'}}" style="cursor:pointer ;">
                                                    <p class="font-weight-bold h4">C</p>
                                                    <input id="c_e" wire:model="energy" style="display: none;" type="radio" value="c" />
                                                </label>
                                                <label for="d_e"  class="{{($energy != 'd') ? 'mr-1 border border-secondary rounded py-1 px-2':'mr-1  bg-primary text-white rounded py-1 px-2'}}" style="cursor:pointer ;">
                                                    <p class="font-weight-bold h4">D</p>
                                                    <input id="d_e" wire:model="energy" style="display: none;" type="radio" value="d" />
                                                </label>
                                                <label for="e_e"  class="{{($energy != 'e') ? 'mr-1 border border-secondary rounded py-1 px-2':'mr-1  bg-primary text-white rounded py-1 px-2'}}" style="cursor:pointer ;">
                                                    <p class="font-weight-bold h4">E</p>
                                                    <input id="e_e" wire:model="energy" style="display: none;" type="radio" value="e" />
                                                </label>
                                                <label for="f_e"  class="{{($energy != 'f') ? 'mr-1 border border-secondary rounded py-1 px-2':'mr-1  bg-primary text-white rounded py-1 px-2'}}" style="cursor:pointer ;">
                                                    <p class="font-weight-bold h4">F</p>
                                                    <input id="f_e" wire:model="energy" style="display: none;" type="radio" value="f" />
                                                </label>
                                                <label for="g_e"  class="{{($energy != 'g') ? 'mr-1 border border-secondary rounded py-1 px-2':'mr-1  bg-primary text-white rounded py-1 px-2'}}" style="cursor:pointer ;">
                                                    <p class="font-weight-bold h4">G</p>
                                                    <input id="g_e" wire:model="energy" style="display: none;" type="radio" value="g" />
                                                </label>
                                                <label for="virgin_e"  class="{{($energy != 'virgin') ? 'mr-1 border border-secondary rounded py-1 px-2':'mr-1  bg-primary text-white rounded py-1 px-2'}}" style="cursor:pointer ;">
                                                    <p class="font-weight-bold h4">Virgin</p>
                                                    <input id="virgin_e" wire:model="energy" style="display: none;" type="radio" value="virgin" />
                                                </label>

                                            </div>  
                                            @error('energyclass') <span class="mt-1 text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-6">
                                             <label>{{__('lang.ges')}}</label>
                                             <div>
                                                <label for="a" class="{{($ges != 'a') ? 'mr-1 border border-secondary rounded py-1 px-2':'mr-1  bg-primary text-white rounded py-1 px-2'}}" style="cursor:pointer ;">
                                                    <p class="font-weight-bold h4">A</p>
                                                    <input id="a" wire:model="ges" style="display: none;" type="radio" value="a" />
                                                </label>
                                                <label for="b"  class="{{($ges != 'b') ? 'mr-1 border border-secondary rounded py-1 px-2':'mr-1  bg-primary text-white rounded py-1 px-2'}}" style="cursor:pointer ;">
                                                    <p class="font-weight-bold h4">B</p>
                                                    <input id="b" wire:model="ges" style="display: none;" type="radio" value="b" />
                                                </label>
                                                <label for="c"  class="{{($ges != 'c') ? 'mr-1 border border-secondary rounded py-1 px-2':'mr-1  bg-primary text-white rounded py-1 px-2'}}" style="cursor:pointer ;">
                                                    <p class="font-weight-bold h4">C</p>
                                                    <input id="c" wire:model="ges" style="display: none;" type="radio" value="c" />
                                                </label>
                                                <label for="d"  class="{{($ges != 'd') ? 'mr-1 border border-secondary rounded py-1 px-2':'mr-1  bg-primary text-white rounded py-1 px-2'}}" style="cursor:pointer ;">
                                                    <p class="font-weight-bold h4">D</p>
                                                    <input id="d" wire:model="ges" style="display: none;" type="radio" value="d" />
                                                </label>
                                                <label for="e"  class="{{($ges != 'e') ? 'mr-1 border border-secondary rounded py-1 px-2':'mr-1  bg-primary text-white rounded py-1 px-2'}}" style="cursor:pointer ;">
                                                    <p class="font-weight-bold h4">E</p>
                                                    <input id="e" wire:model="ges" style="display: none;" type="radio" value="e" />
                                                </label>
                                                <label for="f"  class="{{($ges != 'f') ? 'mr-1 border border-secondary rounded py-1 px-2':'mr-1  bg-primary text-white rounded py-1 px-2'}}" style="cursor:pointer ;">
                                                    <p class="font-weight-bold h4">F</p>
                                                    <input id="f" wire:model="ges" style="display: none;" type="radio" value="f" />
                                                </label>
                                                <label for="g"  class="{{($ges != 'g') ? 'mr-1 border border-secondary rounded py-1 px-2':'mr-1  bg-primary text-white rounded py-1 px-2'}}" style="cursor:pointer ;">
                                                    <p class="font-weight-bold h4">G</p>
                                                    <input id="g" wire:model="ges" style="display: none;" type="radio" value="g" />
                                                </label>
                                                <label for="virgin"  class="{{($ges != 'virgin') ? 'mr-1 border border-secondary rounded py-1 px-2':'mr-1  bg-primary text-white rounded py-1 px-2'}}" style="cursor:pointer ;">
                                                    <p class="font-weight-bold h4">Virgin</p>
                                                    <input id="virgin" wire:model="ges" style="display: none;" type="radio" value="virgin" />
                                                </label>
                                            </div>  
                                            @error('ges') <span class="mt-1 text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>{{__('lang.area')}}</label>
                                            <input wire:model="area" type="text" class="form-control">
                                            @error('area') <span class="mt-1 text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>{{__('lang.zipcode')}}</label>
                                            <input wire:model="zipcode" type="text" class="form-control">
                                            @error('zipcode') <span class="mt-1 text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>{{__('lang.address')}}</label>
                                            <input wire:model="address" type="text" class="form-control">
                                            @error('address') <span class="mt-1 text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div  class="form-group col-md-12">
                                           <label>{{__('lang.descriptionproperty')}}</label>       
                                          <textarea wire:model="description" class="form-control"></textarea>
                                           @error('description') <span class="mt-1 text-danger">{{ $message }}</span> @enderror                    
                                        </div>
                                        @endif
                                        @if($current_step == 3)
                                        <div class="form-group col-md-6">
                                            <label>{{__('lang.buildon')}}</label>
                                            <select wire:model="buildon" class="bg-secondary  custom-select custom-select-lg">
                                                @for($i =1910;$i <= Date('Y');$i++)
                                                 <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                            @error('buildon') <span class="mt-1 text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        @if($propertyType == 'houses' || $propertyType == 'apartment' || $propertyType == 'villas')
                                        <div class="form-group col-md-6">
                                            <label>{{__('lang.bedrooms')}}</label>
                                            <select wire:model="bedrooms" class="bg-secondary  custom-select custom-select-lg">
                                                <option value="">{{__('lang.selectnumberofbedrooms')}}</option>
                                                @for($i =1 ;$i <= 5;$i++)
                                                 <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                            @error('bedrooms') <span class="mt-1 text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>{{__('lang.bathrooms')}}</label>
                                            <select wire:model="bathrooms" class="bg-secondary  custom-select custom-select-lg">
                                                <option value="">{{__('lang.selectnumberofbathrooms')}}</option>
                                                @for($i =1 ;$i <= 5;$i++)
                                                 <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                            @error('bathrooms') <span class="mt-1 text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>{{__('lang.rooms')}}</label>
                                            <select wire:model="rooms" class="bg-secondary  custom-select custom-select-lg">
                                                <option value="">{{__('lang.selectnumberofrooms')}}</option>
                                                @for($i =1 ;$i <= 5;$i++)
                                                 <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                            @error('rooms') <span class="mt-1 text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>{{__('lang.amenities')}} {{__('lang.optional')}}</label>
                                            <div class="o-features">
                                                <ul class="no-ul-list third-row">
                                                    <li> 
                                                        <input wire:model="features" value="equippedkitchen" name="a-1" id="a-1" class="checkbox-custom"  type="checkbox">
                                                        <label for="a-1" class="checkbox-custom-label">{{__('lang.equippedkitchen')}}</label>
                                                    </li>
                                                    <li> 
                                                        <input wire:model="features" value="americankitchen" name="a-2" id="a-2" class="checkbox-custom"  type="checkbox">
                                                        <label for="a-2" class="checkbox-custom-label">{{__('lang.americankitchen')}}</label>
                                                    </li>
                                                    <li> 
                                                        <input wire:model="features" value="separatetoilet" name="a-3" id="a-3" class="checkbox-custom"  type="checkbox">
                                                        <label for="a-3" class="checkbox-custom-label">{{__('lang.separatetoilet')}}</label>
                                                    </li>
                                                    <li> 
                                                        <input wire:model="features" value="bathtub" name="a-4" id="a-4" class="checkbox-custom"  type="checkbox">
                                                        <label for="a-4" class="checkbox-custom-label">{{__('lang.bathtub')}}</label>
                                                    </li>
                                                    <li> 
                                                        <input wire:model="features" value="fireplace" name="a-5" id="a-5" class="checkbox-custom"  type="checkbox">
                                                        <label for="a-5" class="checkbox-custom-label">{{__('lang.fireplace')}}</label>
                                                    </li>
                                                    <li> 
                                                        <input wire:model="features" value="airconditioner" name="a-6" id="a-6" class="checkbox-custom"  type="checkbox">
                                                        <label for="a-6" class="checkbox-custom-label">{{__('lang.airconditioner')}}</label>
                                                    </li>
                                                    <li> 
                                                        <input wire:model="features" value="cupboards" name="a-7" id="a-7" class="checkbox-custom"  type="checkbox">
                                                        <label for="a-7" class="checkbox-custom-label">{{__('lang.cupboards')}}</label>
                                                    </li>
                                                    <li> 
                                                        <input wire:model="features" value="parquet" name="a-8" id="a-8" class="checkbox-custom"  type="checkbox">
                                                        <label for="a-8" class="checkbox-custom-label">{{__('lang.parquet')}}</label>
                                                    </li>
                                                    <li> 
                                                        <input wire:model="features" value="alarm" name="a-9" id="a-9" class="checkbox-custom"  type="checkbox">
                                                        <label for="a-9" class="checkbox-custom-label">{{__('lang.alarm')}}</label>
                                                    </li>
                                                    <li> 
                                                        <input wire:model="features" value="attic" name="a-10" id="a-10" class="checkbox-custom"  type="checkbox">
                                                        <label for="a-10" class="checkbox-custom-label">{{__('lang.attic')}}</label>
                                                    </li>
                                                    <li> 
                                                        <input wire:model="features" value="balcony" name="a-11" id="a-11" class="checkbox-custom"  type="checkbox">
                                                        <label for="a-11" class="checkbox-custom-label">{{__('lang.balcony')}}</label>
                                                    </li>
                                                    <li> 
                                                        <input wire:model="features" value="terrace" name="a-12" id="a-12" class="checkbox-custom"  type="checkbox">
                                                        <label for="a-12" class="checkbox-custom-label">{{__('lang.terrace')}}</label>
                                                    </li>
                                                    <li> 
                                                        <input wire:model="features" value="garden" name="a-13" id="a-13" class="checkbox-custom"  type="checkbox">
                                                        <label for="a-13" class="checkbox-custom-label">{{__('lang.garden')}}</label>
                                                    </li>
                                                    <li> 
                                                        <input wire:model="features" value="garageparking" name="a-14" id="a-14" class="checkbox-custom"  type="checkbox">
                                                        <label for="a-14" class="checkbox-custom-label">{{__('lang.garageparking')}}</label>
                                                    </li>
                                                    <li> 
                                                        <input wire:model="features" value="cellar" name="a-15" id="a-15" class="checkbox-custom"  type="checkbox">
                                                        <label for="a-15" class="checkbox-custom-label">{{__('lang.cellar')}}</label>
                                                    </li>
                                                    <li> 
                                                        <input wire:model="features" value="swimmingpool" name="a-16" id="a-16" class="checkbox-custom"  type="checkbox">
                                                        <label for="a-16" class="checkbox-custom-label">{{__('lang.swimmingpool')}}</label>
                                                    </li>
                                                    <li> 
                                                        <input wire:model="features" value="tennis" name="a-17" id="a-17" class="checkbox-custom"  type="checkbox">
                                                        <label for="a-17" class="checkbox-custom-label">{{__('lang.tennis')}}</label>
                                                    </li>
                                                    <li> 
                                                        <input wire:model="features" value="elevator" name="a-18" id="a-18" class="checkbox-custom"  type="checkbox">
                                                        <label for="a-18" class="checkbox-custom-label">{{__('lang.elevator')}}</label>
                                                    </li>
                                                    <li> 
                                                        <input wire:model="features" value="guardian" name="a-19" id="a-19" class="checkbox-custom"  type="checkbox">
                                                        <label for="a-19" class="checkbox-custom-label">{{__('lang.guardian')}}</label>
                                                    </li>
                                                    <li> 
                                                        <input wire:model="features" value="digicode" name="a-20" id="a-20" class="checkbox-custom"  type="checkbox">
                                                        <label for="a-20" class="checkbox-custom-label">{{__('lang.digicode')}}</label>
                                                    </li>
                                                    <li> 
                                                        <input wire:model="features" value="intercom" name="a-21" id="a-21" class="checkbox-custom"  type="checkbox">
                                                        <label for="a-21" class="checkbox-custom-label">{{__('lang.intercom')}}</label>
                                                    </li>
                                                    <li> 
                                                        <input wire:model="features" value="calm" name="a-22" id="a-22" class="checkbox-custom"  type="checkbox">
                                                        <label for="a-22" class="checkbox-custom-label">{{__('lang.calm')}}</label>
                                                    </li>
                                                    <li> 
                                                        <input wire:model="features" value="heater" name="a-23" id="a-23" class="checkbox-custom"  type="checkbox">
                                                        <label for="a-23" class="checkbox-custom-label">{{__('lang.heater')}}</label>
                                                    </li>
                                                    <li> 
                                                        <input wire:model="features" value="luminous" name="a-24" id="a-24" class="checkbox-custom"  type="checkbox">
                                                        <label for="a-24" class="checkbox-custom-label">{{__('lang.luminous')}}</label>
                                                    </li>
                                                   
                                                </ul>
                                              </div>
                                           <div>
                                          </div>
                                       </div>
                                        @endif
                                        @if($propertyType == 'houses'|| $propertyType == 'villas')
                                        <div class="form-group col-md-6">
                                            <label>{{__('lang.garage')}}</label>
                                            <select wire:model="garage" class="bg-secondary  custom-select custom-select-lg">
                                                <option value="">{{__('lang.selectnumberofgarage')}}</option>
                                                @for($i =1 ;$i <= 5;$i++)
                                                 <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                            @error('garage') <span class="mt-1 text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        @endif
                                        @endif
                                        @if($current_step == 4)
                                        <div class="form-group col-md-12">
                                            <label>
                                                {{__('lang.propertyphotos')}} : ({{__('lang.propertyphotosdescription')}})
                        
                                            </label>
                                           <div class="row">
                                            @if(count($photos) > 0)
                                                    @foreach($photos as $key=>$photo)
                                                    <div class="col-md-3 text-center" wire:key="{{$key}}">
                                                        <div>
                                                            <img  class="rounded" width="100" height="100" src="{{ $photo->temporaryUrl() }}">
                                                        </div>
                                                        <button class="mt-1 btn btn-danger btn-sm" wire:click="removeMe({{$key}})"><i class="ti-trash"></i></button>
                                                    </div>
                                                    @endforeach
                                            @endif
                                
                                           </div>
                                           <div>
                                            <div wire:loading wire:target="photos">
                                                <div class="spinner-border text-danger" role="status">
                                                    <span class="sr-only"></span>
                                                  </div>
                                            </div>
                                            <label for="photos">
                                                <svg width="100" height="100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
                                                    <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
                                                </svg>
                                                <input id="photos" wire:model="photos"  style="display: none;" type="file" multiple/>
                                            </label>
                                             @error('photos') <span class="mt-1 text-danger">{{ $message }}</span> @enderror
                                        </div>
                                           </div>
                                        </div>
                                        @endif
                                        @if($current_step == 5)
                                          <div class="form-group col-md-12">
                                               <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label>{{__('lang.fullname')}}</label>
                                                    <input wire:model="name" type="text" class="form-control">
                                                    @error('name') <span class="mt-1 text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                
                                                <div class="form-group col-md-4">
                                                    <label>{{__('lang.email')}}</label>
                                                    <input wire:model="email" type="text" class="form-control">
                                                    @error('email') <span class="mt-1 text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                
                                                <div class="form-group col-md-4">
                                                    <label>{{__('lang.phone')}} - {{__('lang.optional')}} </label>
                                                    <input wire:model="phone" type="text" class="form-control">
                                                    @error('phone') <span class="mt-1 text-danger">{{ $message }}</span> @enderror
                                                </div>
                                               </div>   
                                          </div>
                                        </div>
                                        </div>
                                        @endif
                                        <div class="form-group col-md-12">
                                            
                                             <div class="d-flex justify-content-between">
                                                  
                                                    <div>
                                                        @if($current_step > 1)
                                                        <button wire:click="prevstep" class="btn btn-secondary">
                                                            {{__('lang.return')}}
                                                        </button>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        @if($current_step < 5)
                                                        <button wire:click="nextstep()" class="btn btn-primary">
                                                            {{__('lang.continue')}}
                                                        </button>
                                                        @endif
                                                        @if($current_step === 5)
                                                        <button wire:click="save()" class="btn btn-primary">
                                                            {{__('lang.send')}}
                                                        </button>
                                                        @endif
                                                    </div>
                                             </div>
                                        </div>                                      
                                    </div>
                                </div>
                            </div>
                     
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if($errors->any())
    <script>
       $('#back2Top').click();
    </script>
    @endif

</div>





