<section>
<div class="container">
    <div class="row">
         <div class="col-md-6 mx-auto">
             <h2 class="text-center">{{__('lang.forgot_your_password')}}</h2>
             <h3 class="text-center mt-2 text-success">{{$success_forgot_message}}</h3>
             <h3 class="text-center mt-2  text-danger">{{$error_forgot_message}}</h3>
            @error('email')
            <h3 class="text-center mt-2  text-danger">{{ $message }}</h3>
            @enderror
            <div class="form-group">
                <div class="input-with-icon">
                    <input  type="email" wire:model="email" class="form-control" placeholder="{{__('lang.email')}}">
                    <i class="ti-email"></i>
                </div>
            </div>
            <div class="form-group">
                <button wire:click="sendmail" class="btn btn-theme-2 btn-block">{{__('lang.send')}}</button>
            </div>

         </div>
    </div>
</div>
</section>

