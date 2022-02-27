@extends('layouts.app')
@section('content')
<section class="error-wrap">
    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-lg-6 col-md-10">
                <div class="text-center">
                    
                    <img src="{{asset('img/404.png')}}" class="img-fluid" alt="">
                   
                    <a class="btn btn-theme" href="{{route('home')}}">{{__('lang.backtohome')}}</a>
                    
                </div>
            </div>
            
        </div>
    </div>
</section>
@endsection