@extends('layouts.app')
@section('content')
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                
                <h2 class="ipt-title">{{$post->title}}</h2>
                <span class="ipn-subtitle">{{$post->category->category}}</span>
                
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
            <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="blog-details single-post-item format-standard">
                    <div class="post-details">
                    
                        <div class="post-featured-img">
                            <img class="img-fluid" src="{{asset($post->photo)}}" alt="{{$post->title}}">
                        </div>
                        
                        <div class="post-top-meta">
                            <ul class="meta-comment-tag">
                                <li><a href="#"><span class="icons"><i class="ti-user"></i></span>{{__('lang.by')}} {{config('app.name')}}</a></li>
                            </ul>
                        </div>
                        <h2 class="post-title">{{$post->title}}</h2>
                        <div>
                            {!! $post->content !!}
                        </div>
                        <div class="post-bottom-meta">
                            <div class="post-tags">
                                <h4 class="pbm-title">{{__('lang.relatedtags')}}</h4>
                                <ul class="list">
                                    @if(count($post->tags) > 0)
                                    @foreach($post->tags as $tag)
                                    <li><a href="{{route('blog.tag',['tag'=>$tag->slug])}}">{{$tag->tag}}</a></li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="post-share">
                                <h4 class="pbm-title">{{__('lang.socialshare')}}</h4>
                                <ul class="list">
                                    <li><a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}&t={{$post->title}}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="{{__('lang.shareonfacebook')}}"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="https://twitter.com/share?url={{url()->current()}}&text={{$post->title}}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="{{__('lang.shareontwitter')}}"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="whatsapp://send?text={{url()->current()}}" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="{{__('lang.shareonwhatsapp')}}"><i class="fab fa-whatsapp"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="single-post-pagination">
                            <div class="prev-post">
                                @if(!empty($prev))
                                <a href="{{route('blog',['slug'=>$prev->slug])}}">
                                    <div class="title-with-link">
                                        <span class="intro">{{__('lang.prevpost')}}</span>
                                        <h3 class="title">{{Str::limit($prev->title,15)}}</h3>
                                    </div>
                                </a>
                                @endif
                            </div>
                            <div class="post-pagination-center-grid">
                                <a href="#"><i class="ti-layout-grid3"></i></a>
                            </div>
                            <div class="next-post">
                                @if(!empty($next))
                                <a href="{{route('blog',['slug'=>$next->slug])}}">
                                    <div class="title-with-link">
                                        <span class="intro">{{__('lang.nextpost')}}</span>
                                        <h3 class="title">{{Str::limit($next->title,15)}}</h3>
                                    </div>
                                </a>
                                @endif
                            </div>
                        </div>
                        
                    </div>
                </div>
                
               
                
                
            </div>
            
            <!-- Single blog Grid -->
            <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                
                <!-- Searchbard -->
                <div class="single-widgets widget_search">
                    <h4 class="title">{{__('lang.search')}}</h4>
                    <form action="{{route('blog.search')}}" class="sidebar-search-form">
                        <input type="search" name="search" placeholder="{{__('lang.search')}}..">
                        <button type="submit"><i class="ti-search"></i></button>
                    </form>
                </div>

                <!-- Categories -->
                <div class="single-widgets widget_category">
                    <h4 class="title">{{__('lang.categories')}}</h4>
                    <ul>
                        @if(count($categories) > 0)
                        @foreach($categories as $category)
                        <li><a href="{{route('blogs',['category'=>$category->slug])}}">{{$category->category}} <span>{{count($category->posts)}}</span></a></li>
                        @endforeach
                        @endif
                    </ul>
                </div>
                
                <!-- Trending Posts -->
                <div class="single-widgets widget_thumb_post">
                    <h4 class="title">{{__('lang.trendingposts')}}</h4>
                    <ul>
                        @if(count($posts) > 0)
                        @foreach($posts as $post)
                        <li>
                            <span class="left">
                                <img src="{{asset($post->photo)}}" alt="$post->title">
                            </span>
                            <span class="right">
                                <a class="feed-title" href="{{route('blog',['slug'=>$post->slug])}}">{{Str::limit($post->title,25)}}</a> 
                                <span class="post-date"><i class="ti-calendar"></i>{{$post->created_at->diffForHumans()}}</span>
                            </span>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
                
                <!-- Tags Cloud -->
                <div class="single-widgets widget_tags">
                    <h4 class="title">{{__('lang.tagscloud')}}</h4>
                    <ul>
                        @if(count($tags) > 0)
                        @foreach($tags as $tag)
                         <li><a href="{{route('blog.tag',['tag'=>$tag->slug])}}">{{$tag->tag}}</a></li>
                        @endforeach
                        @endif
                    </ul>
                </div>
                
            </div>
            
        </div>
        <!-- /row -->					
        
    </div>
            
</section>
@endsection