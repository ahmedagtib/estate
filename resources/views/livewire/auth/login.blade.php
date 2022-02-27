    <div wire:ignore.self class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="registermodal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
            <div class="modal-content" id="registermodal">
                <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
                <div class="modal-body">
                    <h4 class="modal-header-title">{{__('lang.login')}}</h4>
                    <div class="login-form">
                        <form wire:submit.prevent="login">
                            <h4 class="text-center text-danger">
                                {{$error}}
                            </h4>
                            <div class="form-group">
                                <label>{{__('lang.email')}}</label>
                                <div class="input-with-icon">
                                    <input type="email" wire:model.defer="email" class="form-control" placeholder="{{__('lang.email')}}">
                                    <i class="ti-email"></i>
                                </div>
                                <p class="text-danger">@error('email') <span class="error">{{ $message }}</span> @enderror</p>
                            </div>
                            
                            <div class="form-group">
                                <label>{{__('lang.password')}}</label>
                                <div class="input-with-icon">
                                    <input type="password" wire:model.defer="password" class="form-control" placeholder="*******">
                                    <i class="ti-unlock"></i>
                                </div>
                                <p class="text-danger">@error('password') <span class="error">{{ $message }}</span> @enderror</p>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-md full-width pop-login">
                                    {{__('lang.login')}}
                                    <span class="spinner-border text-light" role="status" wire:loading wire:target="login">
                                      
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
                        <p class="mt-5"><a href="{{route('forgot.password')}}" class="link">{{__('lang.forgot_password')}}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

