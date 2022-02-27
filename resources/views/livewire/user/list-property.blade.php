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
                    
                        <!-- Bookmark Property -->
                        <div class="form-submit">
                            <div class="d-flex justify-content-between">
                                <h4>{{__('lang.myproperty')}}</h4>
                                <a href="{{route('create.property')}}" class="btn btn-primary text-white">{{__('lang.newproperty')}}</a>
                            </div>	
                           
                        </div>
                        
                        <table class="mt-2 property-table-wrap responsive-table">

                            <tbody>
                                <tr>
                                    <th><i class="fa fa-file-text"></i> {{__('lang.property')}}</th>
                                    <th class="expire-date"><i class="fa fa-calendar"></i> {{__('lang.poststatus')}}</th>
                                    <th></th>
                                </tr>
                                @if(count($properties) > 0)
                                  @foreach($properties as $property)
                                  <tr>
                                    <td class="property-container">
                                        <img width="50"  height="80" src="{{asset($property->image)}}" alt="">
                                        <div class="title">
                                            <h4><a href="#">{{$property->title}}</a></h4>
                                            <span>{{$property->adress}}</span>
                                            <span class="table-property-price">${{$property->price}}</span>
                                        </div>
                                    </td>
                                    <td class="expire-date">
                                        @if($property->poststatus == 'pending')
                                        <span class="badge badge-warning">{{__('lang.pending')}}</span>
                                        @endif
                                        @if($property->poststatus == 'published')
                                         <span class="badge badge-success">{{__('lang.published')}}</span>
                                        @endif
                                    </td>
                                    <td class="action">
                                        <a href="{{route('update.property',['slug'=>$property->slug])}}"><i class="ti-pencil"></i> {{__('lang.edit')}}</a>
                                        <a href="{{route('property',['slug'=>$property->slug])}}"><i class="ti-eye"></i> {{__('lang.show')}}</a>
                                        <a href="#" wire:click="removeProperty('{{$property->slug}}')" class="delete"><i class="ti-close"></i> {{__('lang.delete')}}</a>
                                    </td>
                                </tr>
                                  @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="mt-1">
                            {{ $properties->links() }}
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
</div>
