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
                            <h4>{{__('lang.managestate')}}</h4>
                            <div class="submit-section">
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label>{{__('lang.enterstate')}}</label>
                                        <input type="hidden" wire:model="idstate" value="idstate"/>
                                        <input type="text" wire:model="state" class="form-control" placeholder="{{__('lang.enterstate')}}">
                                        @error('state') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div> 
                                    <div class="form-group col-lg-12 col-md-12">
                                       @if($button)
                                        <button class="btn btn-warning" type="submit" wire:click="update()">{{__('lang.savechanges')}}</button>
                                        <button class="btn btn-info" type="submit" wire:click="clear">{{__('lang.clear')}}</button>
                                        @else
                                        <button class="btn btn-theme" type="submit" wire:click="save">{{__('lang.send')}}</button>
                                       @endif 
                                   </div> 
                                </div>
                            </div>
                            @if($allstate)
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{__('lang.state')}}</th>
                                    <th scope="col">{{__('lang.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allstate as $s)
                                <tr>
                                  <th scope="row">{{$s->id}}</th>
                                  <td>{{$s->state}}</td>
                                  <td>
                                      <button wire:click="edit({{$s->id}})" class="btn btn-warning">
                                          <i class="ti-pencil-alt"></i> 
                                      </button>
                                      <button wire:click="delete({{$s->id}})" class="btn btn-danger">
                                        <i class="ti-trash"></i> 
                                      </button>
                                  </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                            {{ $allstate->links() }}
                        
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

