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
                            <h4>{{__('lang.pendingpropetites')}}</h4>
                            <div class="submit-section">
                                <div>
                                    <button class="btn btn-success" wire:click="change">{{__('lang.makeselectedchamp')}}</button>
                                    <p class="text-danger">@error('array') <span class="error">{{ $message }}</span> @enderror</p>
                                </div>
                                @if(count($properties) > 0)
                                <table class="table table-striped">
                                    <thead>
                                      <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{__('lang.property')}}</th>
                                        <th scope="col">{{__('lang.show')}}</th>
                                        <th scope="col">{{__('lang.accepted')}}</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                     @foreach($properties as $item)
                                      <tr>
                                        <th scope="row">{{$item->id}}</th>
                                        <td>{{$item->title}}</td>
                                        <td>
                                            <a href="{{route('property',$item->slug)}}">
                                                <i class="ti-pencil"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <input wire:model="array" type="checkbox"  value="{{$item->id}}" />
                                        </td>
                                      </tr>
                                     @endforeach 
                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>
                     </div>
                   </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </section>
</div>


