@extends('layouts.app')
@section('content')
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                @if($option == 'blog')
                <h2 class="ipt-title">{{__('lang.ourarticles')}}</h2>
                <span class="ipn-subtitle">{{__('lang.blogdescription')}}</span>
                @endif
                @if($option == 'tag')
                <h2 class="ipt-title">{{$title}}</h2>
                <span class="ipn-subtitle">{{__('lang.latesttag',['tag'=>$title])}}</span>
                @endif
                @if($option == 'category')
                <h2 class="ipt-title">{{$title}}</h2>
                @endif
                @if($option == 'search')
                <h2 class="ipt-title">{{__('lang.yoursearch',['search'=>$title])}}</h2>
                @endif
            </div>
        </div>
    </div>
</div>
<section>

    <div class="container">
        @if(count($data) > 0)
            
        <div class="row">
             @foreach($data as $d)
            <div class="col-lg-4 col-md-6">
                <div class="blog-wrap-grid">
                    
                    <div class="blog-thumb">
                        <a href="{{route('blog',['slug'=>$d->slug])}}"><img src="{{asset($d->photo) }}" class="img-fluid" alt="{{$d->title}}" /></a>
                    </div>
                    
                    <div class="blog-info">
                        <span class="post-date"><i class="ti-calendar"></i>{{$d->created_at->diffForHumans()}}</span>
                    </div>
                    
                    <div class="blog-body">
                        <h4 class="bl-title"><a href="{{route('blog',['slug'=>$d->slug])}}">{{$d->title}}</a></h4>
                        <p>{{Str::limit($d->excerpt,30)}}</p>
                        <a href="{{route('blog',['slug'=>$d->slug])}}" class="bl-continue">{{__('lang.continue')}}</a>
                    </div>
                    
                </div>
            </div>
            @endforeach

           
                  
        </div>
        <!-- /row -->

        <!-- Pagination -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <ul class="pagination p-center">
                    {{$data->links()}}
                </ul>
            </div>
        </div>					
        @endif
    </div>
            
</section>
@endsection
