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
                            <h4>{{__('lang.managecities')}}</h4>
                            <div class="submit-section">
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <label>{{__('lang.choosecity')}} - {{$state_id}}</label>
                                                <select wire:model="state_id"   class="custom-select form-control"  style="color:#868e96;" >
                                                    @if($allstates->count() > 0) 
                                                    <option  value="-1">{{__('lang.choosecity')}}</option>  
                                                        @foreach ($allstates as $state)
                                                        <option  value="{{$state->id}}" >{{$state->state}}</option>
                                                        @endforeach
                                                    @else
                                                    <option  value="-1">{{__('lang.nostatefound')}}</option>  
                                                    @endif
                                                </select> 
                                            </div>
                                            <p class="text-danger">@error('state_id') <span class="error">{{ $message }}</span> @enderror</p>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label>{{__('lang.entercity')}}</label>
                                        <input type="hidden" wire:model="idcity" value="idstate"/>
                                        <input type="text" wire:model="city" class="form-control" placeholder="{{__('lang.entercity')}}">
                                        @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div> 
                                    <div class="form-group col-lg-12 col-md-12">
                                       @if($button)
                                        <button class="btn btn-warning" type="submit" wire:click="update()">{{__('lang.savechanges')}}</button>
                                        <button class="btn btn-info" type="submit" wire:click="clear()">{{__('lang.clear')}}</button>
                                       @else
                                        <button class="btn btn-theme" type="submit" wire:click="save">{{__('lang.send')}}</button>
                                       @endif 
                                   </div> 
                                </div>
                            </div>
                            @if($allcity)
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{__('lang.city')}}</th>
                                    <th scope="col">{{__('lang.state')}}</th>
                                    <th scope="col">{{__('lang.action')}}</th>
                                </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allcity as $c)
                                        <tr>
                                        <th scope="row">{{$c->id}}</th>
                                        <td>{{$c->city}}</td>
                                        <td>{{$c->state->state}}</td>
                                        <td>
                                            <button wire:click="edit({{$c->id}})" class="btn btn-warning">
                                                <i class="ti-pencil-alt"></i> 
                                            </button>
                                            <button wire:click="delete({{$c->id}})" class="btn btn-danger">
                                                <i class="ti-trash"></i> 
                                            </button>
                                        </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                            @endif
                        </div>
                        {{ $allcity->links() }}
                    
                         </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </section>
</div>

