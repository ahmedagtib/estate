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
                        <h4>{{__('lang.allpage')}}</h4>
                        <a href="{{route('page.create')}}" class="btn btn-primary text-white">{{__('lang.createnewpage')}}</a>
                        <table class="table mt-2">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{__('lang.image')}}</th>
                                <th scope="col">{{__('lang.pagetitle')}}</th>
                                <th scope="col">{{__('lang.action')}}</th>
                            </tr>
                                </thead>
                                <tbody>
                                    @foreach($allpages as $page)
                                    <tr>
                                    <th scope="row">{{$page->id}}</th>
                                    <td>
                                        <img src="{{asset($page->image)}}" width="50" height="50" />
                                    </td>
                                    <td>{{$page->title}}</td>
            
                                    <td>
                                        <a  href="{{route('page.update',['id'=>$page->id])}}"  class="btn btn-warning">
                                            <i class="ti-pencil-alt"></i> 
                                        </a>
                                        <button  wire:click="delete({{$page->id}})" class="btn btn-danger">
                                            <i class="ti-trash"></i> 
                                        </button>
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>


