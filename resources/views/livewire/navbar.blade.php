<div>
    <div class="header header-light">
        <nav class="headnavbar">
            <div class="nav-header">
                <a href="{{route('home')}}" class="brand"><img src="{{asset($logo)}}" alt="{{Config('app.name')}}" /></a>
                <button class="toggle-bar"><span class="ti-align-justify"></span></button>	
            </div>								
            <ul class="menu">
            
                <li><a href="{{route('home')}}">{{__('lang.home')}}</a></li>
             
                
                <li class="dropdown">
                    <a href="JavaScript:Void(0);">{{__('lang.properties')}}</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('list.properties')}}">{{__('lang.allproperties')}}</a></li>                                    
                        <li><a href="{{route('rent.properties')}}">{{__('lang.propertiesrent')}}</a></li>                                    
                        <li><a href="{{route('sale.properties')}}">{{__('lang.propertiessale')}}</a></li>   
                    </ul>
                </li>
                
                <li><a href="{{route('blogs')}}">{{__('lang.blogs')}}</a></li> 
                <li>
                    <a href="{{route('contactus')}}">{{__('lang.contactus')}}</a>                                
                </li>
                @if(!Auth::check())
                <li><a href="#" data-toggle="modal" data-target="#signup">{{__('lang.sign_up')}}</a></li>
                @endif

            </ul>
             @auth 
             <ul class="attributes">
                <li class="login-attri">
                    <div class="btn-group account-drop">
                        <button type="button" class="btn btn-order-by-filt" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           @if(!empty(Auth::user()->avatar)) 
                            <img src="{{asset(Auth::user()->avatar)}}" class="avater-img" alt="">{{__('lang.hillo')}} {{Auth::user()->fullname}}
                           @else 
                            <img src="{{asset('images/avatar/default.jpg')}}" class="avater-img" alt="{{Auth::user()->fullname}}" title="{{Auth::user()->fullname}}">
                            <span class="d-none d-sm-block">{{__('lang.hillo')}} {{Auth::user()->fullname}}</span>
  
                           @endif
                        </button>
                        <div class="dropdown-menu pull-right animated flipInX">
                            <a href="{{route('profile')}}"><i class="ti-user"></i>{{__('lang.myprofile')}}</a>                                  
                            <a href="{{route('myproperty')}}"><i class="ti-layers"></i>{{__('lang.myproperty')}}</a>                                                                     
                            <a  href="{{route('update.password')}}"><i class="ti-unlock"></i>{{__('lang.updatepassword')}}</a>
                            <a  href="{{route('logout')}}" ><i class="ti-power-off"></i>{{__('lang.logout')}}</a> 
                        </div>
                    </div>
                </li>
            </ul>
             @else
            <ul class="attributes">
                <li class="login-attri theme-log"><a href="#" data-toggle="modal" data-target="#login">{{__('lang.login')}}</a></li>
                <li class="submit-attri theme-log">
                    <a href="{{route('create.property')}}">{{__('lang.submitproperty')}}</a>
                </li>
            </ul>
            @endauth
            
        </nav>
    </div>
</div>
