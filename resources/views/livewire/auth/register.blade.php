<div wire:ignore.self class="modal fade signup" id="signup" tabindex="-1" role="dialog" aria-labelledby="sign-up" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="sign-up">
            <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
            <div class="modal-body">
                <h4 class="modal-header-title">{{__('lang.sign_up')}}</h4>
                <div class="login-form">
                    <form wire:submit.prevent="save">
                        
                        <div class="row">
                            
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <div class="input-with-icon">
                                        <input type="text" class="form-control" wire:model.defer="fullname"  placeholder="{{__('lang.fullname')}}">
                                        <i class="ti-user"></i>
                                    </div>
                                    <p class="text-danger">@error('fullname') <span class="error">{{ $message }}</span> @enderror</p>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <div class="input-with-icon">
                                        <input type="email" class="form-control" wire:model.defer="email"  placeholder="{{__('lang.email')}}">
                                        <i class="ti-email"></i>
                                    </div>
                                    <p class="text-danger">@error('email') <span class="error">{{ $message }}</span> @enderror</p>
                                </div>
                            </div>
                            
                                
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <div class="input-with-icon">
                                        <input type="text" class="form-control" wire:model.defer="phone" placeholder="{{__('lang.phone')}}">
                                        <i class="lni-phone-handset"></i>
                                    </div>
                                    <p class="text-danger">@error('phone') <span class="error">{{ $message }}</span> @enderror</p>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <div class="input-with-icon">
                                        <select wire:model.defer="type"   class="custom-select form-control"  style="color:#868e96;" >
                                            <option value="-1">{{__('lang.select_account_type')}}</option>
                                            <option  value="particulier">{{__('lang.particular')}}</option>
                                            <option   value="professionnel">{{__('lang.professional')}}</option>
                                        </select>
                                        <i class="ti-briefcase"></i>
                                       
                                    </div>
                                    <p class="text-danger">@error('type') <span class="error">{{ $message }}</span> @enderror</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <div class="input-with-icon">
                                        <input type="password" wire:model.defer="password" class="form-control" placeholder="{{__('lang.password')}}" />
                                        <i class="ti-unlock"></i>
                                    </div>
                                </div>
                                <p class="text-danger">@error('password') <span class="error">{{ $message }}</span> @enderror</p>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <div class="input-with-icon">
                                        <input type="password"   wire:model.defer="password_confirmation" class="form-control" placeholder="{{__('lang.password_confirmation')}}"/>
                                        <i class="ti-unlock"></i>
                                    </div>
                                </div>
                                <p class="text-danger">@error('password_confirmation') <span class="error">{{ $message }}</span> @enderror</p>
                            </div>
                            
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-md full-width pop-login">
                                {{__('lang.sign_up')}}
                                <span wire:loading wire:target="save">
                                    <div class="spinner-border text-white" role="status">
                                        <span class="visually-hidden"></span>
                                     </div>
                                </span>
                            </button>
                            
                        </div>
                    
                    </form>
                </div>
                @if($theme->facebook || $theme->gmail)
                <div class="modal-divider"><span>{{__('lang.or_login_via')}}</span></div>
                @endif
                <div class="social-login mb-3">
                    <ul>
                        @if($theme->facebook)
                        <li><a href="{{route('auth.facebook')}}" class="btn connect-fb"><i class="ti-facebook"></i>Facebook</a></li>
                        @endif
                        @if($theme->gmail)
                        <li><a href="{{route('auth.google')}}" class="btn connect-google"><i class="ti-google"></i>Gmail</a></li>
                        @endif
                    </ul>
                </div>
                <div class="text-center">
                    <p class="mt-5"><i class="ti-user mr-1"></i>{{__('lang.already_have_an_account')}} <a href="script:void(0)" id="gologin"  class="link">{{__('lang.go_for_login')}}</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

