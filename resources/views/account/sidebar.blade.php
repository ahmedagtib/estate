<div class="col-lg-4 col-md-12">
    <div class="dashboard-navbar">
        
        <div class="d-user-avater">
            @empty(auth()->user()->avatar)
            <img src="{{asset('images/avatar/default.jpg')}}" class="img-fluid avater" alt="{{auth()->user()->fullname}}">
            @else 
            <img src="{{asset(auth()->user()->avatar)}}" class="img-fluid avater" alt="{{auth()->user()->fullname}}">
            @endempty

            <h4>{{auth()->user()->fullname}}</h4>
            @empty(auth()->user()->email_verified_at)
              <span class="text-danger">{{__('lang.account_unverified')}}</span>
            @else 
              <span class="text-success">{{__('lang.account_verified')}}</span>   
            @endempty
           
        </div>
        
        <div class="d-navigation">
            <ul>
                <li class="{{ Request::routeIs('profile') ? 'active' : '' }}"><a href="{{route('profile')}}"><i class="ti-user"></i>{{__('lang.myprofile')}}</a></li>
                <li class="{{ Request::routeIs('update.password') ? 'active' : '' }}"><a href="{{route('update.password')}}"><i class="ti-unlock"></i>{{__('lang.updatepassword')}}</a></li>
                <li class="{{ Request::routeIs('myproperty') ? 'active' : '' }}"><a href="{{route('myproperty')}}"><i class="ti-layers"></i>{{__('lang.myproperty')}}</a></li>
                <li class="{{ Request::routeIs('create.property') ? 'active' : '' }}"><a href="{{route('create.property')}}"><i class="ti-pencil-alt"></i>{{__('lang.submitnewproperty')}}</a></li>
                @if(Auth::user()->hasRole('admin'))
                <li class="{{ Request::routeIs('state') ? 'active' : '' }}"><a href="{{route('state')}}"><i class="ti-map"></i>{{__('lang.managestate')}}</a></li>
                <li class="{{ Request::routeIs('city') ? 'active' : '' }}"><a href="{{route('city')}}"><i class="ti-location-pin"></i>{{__('lang.managecities')}}</a></li>
                <li class="{{ Request::routeIs('page') ? 'active' : '' }}"><a href="{{route('page')}}"><i class="ti-file"></i>{{__('lang.managepages')}}</a></li>
                <li class="{{ Request::routeIs('category') ? 'active' : '' }}"><a href="{{route('category')}}"><i class="ti-widgetized"></i>{{__('lang.category')}}</a></li>
                <li class="{{ Request::routeIs('tag') ? 'active' : '' }}"><a href="{{route('tag')}}"><i class="ti-widgetized"></i>{{__('lang.tag')}}</a></li>
                <li class="{{ Request::routeIs('tag') ? 'active' : '' }}"><a href="{{route('blog.manage')}}"><i class="ti-widgetized"></i>{{__('lang.blogmanage')}}</a></li>
                <li class="{{ Request::routeIs('findbylocation') ? 'active' : '' }}"><a href="{{route('findbylocation')}}"><i class="ti-map-alt"></i>{{__('lang.findbylocation')}}</a></li>
                <li class="{{ Request::routeIs('pending.property') ? 'active' : '' }}"><a href="{{route('pending.property')}}"><i class="ti-pencil"></i>{{__('lang.pendingpropetites')}}</a></li>
                <li class="{{ Request::routeIs('theme') ? 'active' : '' }}"><a href="{{route('theme')}}"><i class="ti-settings"></i>{{__('lang.customtheme')}}</a></li>
                <li class="{{ Request::routeIs('send.notification') ? 'active' : '' }}"><a href="{{route('send.notification')}}"><i class="ti-settings"></i>send notification</a></li>
                <li class="{{ Request::routeIs('setting.manage') ? 'active' : '' }}"><a href="{{route('setting.manage')}}"><i class="ti-settings"></i>{{__('lang.setting')}}</a></li>
                @endif
                <li class="{{ Request::routeIs('logout') ? 'active' : '' }}"><a href="{{route('logout')}}"><i class="ti-power-off"></i>{{__('lang.logout')}}</a></li>
            </ul>
        </div>
        
    </div>
</div>