@extends('layouts.app')

@section('title', 'Blog')

@section('content')
<div class="blog-banner">
	<img src="{{ asset('frontend/images/banner-img/blog-bannerImg.jpg') }}" alt="">
    <div class="text">
    	<h1>Our <span>Blogs</span></h1>
    </div>
</div>
<section class="content">
	<div class="container">
    	<div class="blog-page">
        	<div class="row">	
            	<div class="col-sm-8 col-md-9 col-lg-9">
            		@foreach($blogs as $blog)
                	<div class="blog-slide">
                    	<div class="date-view">
                        	<div class="date">{{date('d', strtotime($blog->created_at))}}</div>
                            <div class="year">{{date('F,y', strtotime($blog->created_at))}}</div>
                        </div>
                        <div class="blog-info">
                        	<h2>{{$blog->title}}</h2>
                            <div class="sub-title">{{$blog->sub_title}}</div>
                            <div class="img"><img src="../images/blog/{{$blog->image}}" alt=""></div>
                            <div class="outher-link">
                            	<ul>
                                	<li><a href="#"><span class="icon icon-calander-check"></span>{{date('F,Y', strtotime($blog->created_at))}}</a></li>
                                    <li><a href="#"><span class="icon icon-user"></span>{{ App\User::where(['id'=>$blog->posted_by_id])->pluck('name')[0] }}</a></li>
                                    <li><a href="{{ URL::to( '/blog-details/' . $blog->id)  }}"><span class="icon icon-comment"></span>{{App\Review::where(['post_id'=>$blog->id])->where(['table_name'=>'blogs'])->count()}}  Comment</a></li>
                                </ul>
                            </div>
                            <!-- <p>{!!$blog->description!!}</p> -->
                            <a href="{{ URL::to( '/blog-details/' . $blog->id)  }}" class="btn">Read More</a>
                        </div>
                    </div>
                    @endforeach
                    <div class="blog-slide">
                        {{ $blogs->links() }}
                    </div>
                </div>
                <div class="col-sm-4 col-md-3 col-lg-3">
                	<div class="right-blog">
                    <div class="popular-post">
                        <h3>Event Categories</h3>
                        @foreach(App\Category::where('parent_id','!=',0)->orderBy('id', 'desc')->get() as $category)
                        <div class="post-slide">
                            <div class="img"><img src="images/categories/{{$category->img}}" alt=""></div>
                            <div class="post-name"><a href="/organization/<?php print $category->id; ?>">{{ $category->name }}</a></div>
                            
                        </div>
                        @endforeach
                        
                    </div>
                    
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
