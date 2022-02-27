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
                            <h4>{{__('lang.updatepassword')}}</h4>
                            <div class="submit-section">
                                <div class="form-row">
                                
                                    <div class="form-group col-md-8">
                                        <label>{{__('lang.oldpassword')}}</label>
                                        <input type="password" wire:model="oldpassword" class="form-control" placeholder="***********">
                                        @error('oldpassword') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>  
                                    <div class="form-group col-md-8">
                                        <label>{{__('lang.newpassword')}}</label>
                                        <input type="password" wire:model="password" class="form-control" placeholder="************">
                                         @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>  
                                    <div class="form-group col-md-8">
                                        <label>{{__('lang.password_confirmation')}}</label>
                                        <input type="password" wire:model="password_confirmation" class="form-control" placeholder="************">
                                        @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>            
                                </div>
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
