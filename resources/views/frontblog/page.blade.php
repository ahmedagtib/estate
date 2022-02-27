@extends('layouts.app')
@section('content')
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                
                <h2 class="ipt-title">{{$page->title}}</h2>                
            </div>
        </div>
    </div>
</div>
<!-- ============================ Page Title End ================================== -->

<!-- ============================ Agency List Start ================================== -->
<section>

    <div class="container">
    
        <!-- row Start -->
        <div class="row">
        
            <!-- Blog Detail -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="blog-details single-post-item format-standard">
                    <div class="post-details">
                    
                        <div class="post-featured-img">
                            <img class="img-fluid" src="{{asset($page->image)}}" alt="{{$page->title}}">
                        </div>
                        
                        <div class="post-top-meta">
                            <ul class="meta-comment-tag">
                                <li><a href="#"><span class="icons"><i class="ti-user"></i></span>{{__('lang.by')}} {{config('app.name')}}</a></li>
                            </ul>
                        </div>
                        <h2 class="post-title">{{$page->title}}</h2>
                        <div>
                            {!! $page->content !!}
                        </div>
                       
                      
                        
                    </div>
                </div>
                
               
                
                
            </div>
        </div>
        <!-- /row -->					
        
    </div>
            
</section>
@endsection