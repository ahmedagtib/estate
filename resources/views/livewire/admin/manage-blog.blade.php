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
                    <div class="form-submit">
                    <div class="d-flex justify-content-between">
                        <h4>{{__('lang.blogmanage')}}</h4>
                        <a class="btn btn-primary text-white" href="{{route('blog.create')}}">{{__('lang.createblog')}}</a>
                    </div>
                    <div class="mt-2">
                        <input class="form-control" wire:model="titleSearch" placeholder="{{__('lang.searchbytitle')}}"/>
                    </div>
                    <div class="mt-2">
                        @if($posts->count() > 0)
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{__('lang.titleblog')}}</th>
                                <th scope="col">{{__('lang.blogphoto')}}</th>
                                <th scope="col">{{__('lang.statue')}}</th>
                                <th scope="col">{{__('lang.action')}}</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                <tr>
                                    <th scope="row">{{$post->id}}</th>
                                    <td>{{$post->title}}</td>
                                    <td>
                                        <img width="50" height="50" src="{{asset($post->photo)}}" alt="#"/>
                                    </td>
                                    <td>
                                        @if($post->statue == 'pending')
                                        <span class="badge badge-warning">{{__('lang.pending')}}</span>
                                        @endif
                                        @if($post->statue == 'publiched')
                                         <span class="badge badge-success">{{__('lang.published')}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('blog.update',$post->id)}}" class="btn btn-warning">
                                            <i class="ti-pencil-alt"></i> 
                                        </a>
                                        <button wire:click="delete({{$post->id}})" class="btn btn-danger">
                                            <i class="ti-trash"></i> 
                                        </button>
                                    </td>
                                  </tr>
                                  @endforeach
                            </tbody>
                        </table>
                        {{$posts->links()}}
                        @endif
                    </div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
        </div>
     </section>    

</div>



