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
                            <h4>{{__('lang.managecategories')}}</h4>
                            <div class="form-check">
                                <input class="checkbox-custom" wire:model.defer="gmail" name="gmail" type="checkbox"  id="gmail" @if($gmail == 1) checked @endif>
                                <label class="checkbox-custom-label" for="gmail">
                                 {{__('lang.gmailauth')}}
                            </div>
                            <div class="form-check">
                                <input class="checkbox-custom" wire:model.defer="facebook" type="checkbox"  name="facebook" id="facebook" @if($facebook == 1) checked @endif>
                                <label class="checkbox-custom-label" for="facebook">
                                 {{__('lang.facebookauth')}}
                            </div>
                            <div class="form-group">
                                <h6>{{__('lang.property')}} style</h6>
                                <div class="form-check">
                                    <input class="radio-custom" wire:model.defer="propertypage" name="propertypage"  type="radio" value="1" id="propertyone">
                                    <label class="radio-custom-label" for="propertyone">
                                     {{__('lang.property')}} - 1
                                </div>
                                <div class="form-check">
                                    <input class="radio-custom" wire:model.defer="propertypage" name="propertypage" type="radio" value="2" id="propertytow">
                                    <label class="radio-custom-label" for="propertytow">
                                     {{__('lang.property')}} - 2
                                </div>
                                <div class="form-check">
                                    <input class="radio-custom" wire:model.defer="propertypage" name="propertypage" type="radio" value="3" id="propertythere">
                                    <label class="radio-custom-label" for="propertythere">
                                     {{__('lang.property')}}  - 3
                                </div>
                            </div>
                            <div class="form-group">
                                <h6>{{__('lang.home')}} style</h6>
                                <div class="form-check">
                                    <input class="radio-custom" wire:model.defer="homepage" name="homepage" type="radio" value="1" id="homeone">
                                    <label class="radio-custom-label" for="homeone">
                                     {{__('lang.home')}} - 1
                                </div>
                                <div class="form-check">
                                    <input class="radio-custom" wire:model.defer="homepage" name="homepage" type="radio" value="2" id="hometow">
                                    <label class="radio-custom-label" for="hometow">
                                     {{__('lang.home')}} - 2
                                </div>
                                <div>
                                    <button wire:click="send()" class="btn btn-success">{{__('lang.update')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
