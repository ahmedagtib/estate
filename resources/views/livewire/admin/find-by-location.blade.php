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
                        <h4>{{__('lang.findbylocation')}}</h4>
                      <div class="form-group">
                           <label>{{__('lang.imagecdn')}}</label>
                           <input type="text" class="form-control" wire:model="imagecdn" />
                           <p class="text-danger">@error('imagecdn') <span class="error">{{ $message }}</span> @enderror</p>
                      </div>
                      <div class="form-group">
                        <label>{{__('lang.url')}}</label>
                        <input type="text" class="form-control" wire:model="url" />
                        <p class="text-danger">@error('url') <span class="error">{{ $message }}</span> @enderror</p>
                     </div>
                     <div class="form-group">
                        <label>{{__('lang.cityname')}}</label>
                        <input type="text" class="form-control" wire:model="cityname" />
                        <p class="text-danger">@error('cityname') <span class="error">{{ $message }}</span> @enderror</p>
                     </div>
                     <div class="form-group">
                        <label>{{__('lang.numberproperty')}}</label>
                        <input type="text" class="form-control" wire:model="numberproperty" />
                        <p class="text-danger">@error('numberproperty') <span class="error">{{ $message }}</span> @enderror</p>
                     </div>
                     <div class="form-group">
                         <button wire:click="save" class="btn btn-success text-white">{{__('lang.send')}}</button>
                         <button wire:click="clear" class="btn btn-info text-white">{{__('lang.cleardata')}}</button>
                     </div>
                    </div>
                    <div class="clearfix"></div>
                  <div wire:ignore>
                     @if(isset($allcdn)  && count($allcdn) > 0)
                     <table class="table">
                        <thead>
                           <tr>
                              <th>{{__('lang.imagecdn')}}</th>
                              <th>{{__('lang.cityname')}}</th>
                              <th>{{__('lang.numberproperty')}}</th>
                           </tr>
                        </thead>
                        <tbody>
                            @foreach($allcdn as $d)
                            <tr>
                              <td>
                                 <img src="{{  $d['imagecdn']   }}"  width="60" height="60" />
                              </td>
                              <td>{{$d['cityname'] }}</td>
                              <td>{{$d['numberproperty']}}</td>
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
     </section>    

</div>



