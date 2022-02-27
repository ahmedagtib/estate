<div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    
                    <h2 class="ipt-title">{{__('lang.welcome')}}</h2>
                    <span class="ipn-subtitle">{{__('lang.welcome_to_your_account')}}</span>
                    @if(Auth::user()->email_verified_at == null)
                         <div class="alert alert-warning mt-4">
                                {{__('lang.account_not_verified')}} - <a class="text-warning" href="{{route('email.verify')}}">{{__('lang.click')}}</a>
                         </div>
                    @endif
                    @if(Session::has('success'))
                      <div class="alert alert-success mt-4">
                           {{session::get('success')}} 
                      </div>
                    @endif
                    @if(Session::has('error'))
                      <div class="alert alert-danger mt-4">
                           {{session::get('error')}} 
                      </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
    
    <section>
        <div class="container">
            <div class="row">
                 @include('account.sidebar')
                <div class="col-lg-8 col-md-12">
                    <div class="dashboard-wraper">
                    
                        <!-- Basic Information -->
                        <div class="form-submit">	
                            <h4>{{__('lang.myaccount')}}</h4>
                            <div class="submit-section">
                                <div class="form-row">
                                
                                    <div class="form-group col-md-6">
                                        <label>{{__('lang.fullname')}}</label>
                                        <input type="text" wire:model="fullname" class="form-control" value="Shaurya Preet">
                                        @error('fullname') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label>{{__('lang.email')}}</label>
                                        <input disabled type="email" wire:model="email" class="form-control"  value="preet77@gmail.com">
                                   
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label>{{__('lang.title')}}</label>
                                        <input type="text" wire:model="title" class="form-control" value="Web Designer">
                                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label>{{__('lang.phone')}}</label>
                                        <input type="text" wire:model="phone" class="form-control" value="123 456 5847">
                                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label>{{__('lang.address')}}</label>
                                        <input type="text" wire:model="address" class="form-control" value="522, Arizona, Canada">
                                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label>{{__('lang.city')}}</label>
                                        <input type="text" wire:model="city" class="form-control" value="Montquebe">
                                        @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                        <label>{{__('lang.aboutyou')}}</label>
                                        <textarea class="form-control" wire:model="aboutyou">Maecenas quis consequat libero, a feugiat eros. Nunc ut lacinia tortor morbi ultricies laoreet ullamcorper phasellus semper</textarea>
                                        @error('aboutyou') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label >{{__('lang.yourphoto')}}</label>
                                        <input type="file" wire:model="photo"  placeholder="{{__('lang.choosephoto')}}">
                                        <label class="custom-file-label">
                                            <i class="ti-camera ti-2x"></i>  
                                        </label>   
                                        @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                    @if($photo)
                                        <img class="rounded" src="{{ $photo->temporaryUrl() }}" width="80" height="80" />
                                     @endif
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-submit">	
                            <h4>{{__('lang.socialaccounts')}}</h4>
                            <div class="submit-section">
                                <div class="form-row">
                                
                                    <div class="form-group col-md-6">
                                        <label>Facebook</label>
                                        <input type="text" wire:model="facebook" class="form-control" value="https://facebook.com/">
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label>Twitter</label>
                                        <input type="email" wire:model="twitter" class="form-control" value="https://twitter.com/">
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label>Instagram</label>
                                        <input type="text"  wire:model="instagram" class="form-control" value="https://instagram.com/">
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label>LinkedIn</label>
                                        <input type="text" wire:model="linkedin" class="form-control" value="https://linkedin.com/">
                                    </div>
                                </div>
                
                                
                                <div class="form-group col-lg-12 col-md-12">
                                    <button class="btn btn-theme" type="submit" wire:click="save">{{__('lang.savechanges')}}</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </section>
</div>
