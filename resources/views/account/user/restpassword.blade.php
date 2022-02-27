@extends('layouts.app')
@section('content')
<section>
    <div class="container">
        <div class="row">
             <div class="col-md-6 mx-auto">
                 <h1 class="text-center">{{__('lang.reset_password')}}</h1>
                 <form method="POST">
                     @csrf
                    <div class="form-group">
                        <div class="input-with-icon">
                            <input  type="email" disabled name="email" class="form-control" placeholder="{{__('lang.email')}}" value="{{$email}}" />
                            <i class="ti-email"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-with-icon">
                            <input  type="password" name="password"  class="form-control" placeholder="{{__('lang.password')}}">
                            <i class="ti-password"></i>
                        </div>
                        @error('password')
                          <p class="text-danger">{{$message}}</p>  
                        @enderror         
                    </div>
                    <div class="form-group">
                        <div class="input-with-icon">
                            <input  type="password" name="password_confirmation"   class="form-control" placeholder="{{__('lang.password_confirmation')}}">
                            <i class="ti-password"></i>
                            @error('password_confirmation')
                            <p class="text-danger">{{$message}}</p>  
                          @enderror  
                        </div>
                    </div>
                    <div class="form-group">
                        <button  type="submit" class="btn btn-theme-2 btn-block">{{__('lang.send')}}</button>
                    </div>
                 </form>
    
             </div>
        </div>
    </div>
    </section>
    
@endsection
