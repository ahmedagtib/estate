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
                    
                        <h6>aaaaaaaaaaaaa</h6>
                    
                    </div>
                </div>
                        
                </div>
                </div>
                
            </div>
        </div>
    </section>
</div>

