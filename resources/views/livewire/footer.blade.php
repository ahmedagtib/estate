<div>
    <footer class="dark-footer skin-dark-footer">
        <div>
            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            @if(isset($footer->title))
                            <h4 class="widget-title text-bold">{{$footer->footer_title}}</h4>
                            @endif
                            @if(isset($footer->footer_content))
                            <p>{{$footer->footer_content}}</p>
                            @endif
                            @if(isset($footer->andriod_app))
                            <a href="{{$footer->andriod_app}}" class="other-store-link">
                                <div class="other-store-app">
                                    <div class="os-app-icon">
                                        <i class="ti-android"></i>
                                    </div>
                                    <div class="os-app-caps">
                                        Google Store
                                    </div>
                                </div>
                            </a>
                            @endif
                        </div>
                    </div>		
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h4 class="widget-title">{{__('lang.usefullinks')}}</h4>
                            <ul class="footer-menu">
                                @if(count($pages) > 0)
                                @foreach($pages as $page)
                                <li><a href="{{route('page.view',$page->slug)}}">{{$page->title}}</a></li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                            
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h4 class="widget-title">{{__('lang.getintouch')}}</h4>
                            <div class="fw-address-wrap">
                                @if(isset($footer->adress))
                                <div class="fw fw-location">
                                    {{$footer->adress}}
                                </div>
                                @endif
                                @if(isset($footer->email))
                                <div class="fw fw-mail">
                                    {{$footer->email}}
                                </div>
                                @endif
                                @if(isset($footer->phone))
                                <div class="fw fw-call">
                                    {{$footer->phone}}
                                </div>
                                @endif
                                @if(isset($footer->website))
                                <div class="fw fw-web">
                                   {{$footer->website}}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h4 class="widget-title">{{__('lang.followus')}}</h4>
                            <p>{{__('lang.followuscontent')}}</p>
                            <ul class="footer-bottom-social">
                               @if(isset($footer->media))
                               @if($footer->media['facebook']) <li><a href="{{$footer->media['facebook']}}"><i class="ti-facebook"></i></a></li> @endif
                               @if($footer->media['twitter'])  <li><a href="{{$footer->media['twitter']}}"><i class="ti-twitter"></i></a></li>@endif
                               @if($footer->media['instagram'])  <li><a href="{{$footer->media['instagram']}}"><i class="ti-instagram"></i></a></li>@endif
                               @if($footer->media['linkedin'])  <li><a href="{{$footer->media['linkedin']}}"><i class="ti-linkedin"></i></a></li>@endif
                               @endif     
                            </ul>
                            
                            <div class="f-newsletter mt-4">
                                <input wire:model.defer="email" type="email" class="form-control sigmup-me" placeholder="{{__('lang.email')}}">
                                <button wire:click="save" type="submit" class="btn"><i class="ti-arrow-right"></i></button>
                            </div>
                            <p class="text-success">{{$msg}}</p>
                             @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-md-12 text-center">
                        <a href="{{ LaravelLocalization::getLocalizedURL('fr') }}">
                            <img width="50" height="50" class="rounded-circle" src="{{asset('images/world/fr.jpg')}}"  alt="fr"/>
                        </a>
                        <a href="{{ LaravelLocalization::getLocalizedURL('en') }}">
                            <img width="50" height="50"  class="rounded-circle" src="{{asset('images/world/en.jpg')}}"  alt="fr"/>
                        </a>
                    </div>
                    <div class="col-lg-12 col-md-12 text-center">
                        <p class="mb-0">© {{date('Y')}} <a href="{{route('home')}}">{{config('app.name')}}</a> {{__('lang.allrightsreserved')}}</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </footer>
</div>
