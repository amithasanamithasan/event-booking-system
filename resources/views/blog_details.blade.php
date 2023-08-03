@extends('layouts.app')

@section('title', 'Blog details')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Blog</h1>
    </div>
</section>
<section class="content">
	<div class="container">
    	<div class="blog-page">
        	<div class="row">	
            	<div class="col-sm-8 col-md-9 col-lg-9">
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
                            <p>{!!$blog->description!!}</p>
                        </div>
                        <div class="comment-view">
                        	<h2>{{App\Review::where(['post_id'=>$blog->id])->where(['table_name'=>'blogs'])->count()}} Comments</h2>
                        	@foreach($reviews as $review)
                            <div class="comment-box">
                            	<div class="user-img"><img src="../images/users/{{ App\User::where(['id'=>$blog->posted_by_id])->pluck('image')[0] }}" alt=""></div>
                                <div class="comment">
                                	<div class="name">{{ App\User::where(['id'=>$review->user_id])->pluck('name')[0] }} <span>on {{ date('d F,Y H:i:s', strtotime($review->created_at)) }}</span></div>
                                    <div class="sub-title">{{ $review->summery }}</div>
                                    <p>{{ $review->review }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="blog-readInfo">
                        	<h2>People also read</h2>
                            <div class="row">
                            	@foreach(App\Blog::where(['status'=>1])->get() as $blog)
                            	<div class="col-sm-6 col-xs-6">
                                    <div class="user-block">
                                        <div class="img"><img src="../images/blog/{{$blog->image}}" alt=""></div>
                                        <div class="name">{{$blog->title}}</div>
                                        <div class="date">{{date('d F,Y', strtotime($blog->created_at))}}</div>
                                    </div>
                            	</div>
                            	@endforeach
                            </div>
                        </div>
                        <div class="add-comment">
                        	<div class="col-md-12">
				                @if(Session::has('add_review_flash_error'))
				                <div class="alert alert-danger alert-dismissible fade in"  id="myAlert">
				                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				                  <strong>{!! session('add_review_flash_error') !!} !</strong>
				                </div>
				                @endif
				                @if(Session::has('add_review_flash_success'))
				                <div class="alert alert-success alert-dismissible fade in"  id="myAlert">
				                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				                  <strong>{!! session('add_review_flash_success') !!} !</strong>
				                </div>
				                @endif
				                @if ($errors->any())
				                <div class="alert alert-danger alert-dismissible" id="myAlert">
				                  <a href="" class="close">&times;</a>
				                  <ul>
				                  @foreach ($errors->all() as $error)
				                    <li>
				                    <strong>Oh sanp!</strong> {{ $error }}
				                    </li>
				                  @endforeach
				                  </ul>
				                </div>
				                @endif
				            </div>
                        	<h2>Leave a comment <span class="icon icon-comment"></span></h2>
                            <form action="{{ url('/blog-review') }}" method="post">
		                        <div class="review-form">
		                        	{{csrf_field()}}
		                            <div class="single-form">
		                                <input type="hidden" name="post_id" value="{{$blog->id}}" />
		                            </div>
		                            <div class="form-group">
		                                <label>Summery <sup>*</sup></label>
		                                <input type="text" name="summery" class="form-control" placeholder="Write short summery......" />
		                            </div>
		                            <div class="form-group">
		                                <label>Review <sup>*</sup></label>
		                                <textarea name="massage" cols="10" rows="4"  class="form-control" placeholder="Write your review....."></textarea>
		                            </div>
		                        </div>
		                        <div class="review-form-button">
		                            <button type="submit" class="btn btn-success btn-flat" name="submit_review">Post Comment</button>
		                        </div>
		                	</form>
                        </div>
                    </div>
                    
                </div>
                <div class="col-sm-4 col-md-3 col-lg-3">
                	<div class="right-blog">
                        <div class="categories-box">
                            <h3>Categories</h3>
                            <ul>
                                <li><a href="#">Another Blog Category (5)</a></li>
                                <li><a href="#">Latest News (3)</a></li>
                                <li><a href="#">Post Types (2)</a></li>
                            </ul>
                        </div>
                        <div class="popular-post">
                        	<h3>Popular Post</h3>
                            <div class="post-slide">
                                <div class="img"><img src="images/blog-img/post-img.jpg" alt=""></div>
                                <div class="post-name">Gallery Post Type</div>
                                <div class="date">01 Aug 2015 <span class="icon icon-comment"></span> 2 </div>
                                <p>Lorem Ipsum is simply dummy text of the printing and industry...</p>
                            </div>
                            <div class="post-slide">
                                <div class="img"><img src="images/blog-img/post-img2.jpg" alt=""></div>
                                <div class="post-name">Custom Sized & Aligned Featured Images</div>
                                <div class="date">01 Aug 2015 <span class="icon icon-comment"></span> 2 </div>
                                <p>Lorem Ipsum is simply dummy text of the printing and industry Ipsum is simply dummy text of the printing... </p>
                                
                            </div>
                            <div class="post-slide">
                                <div class="img"><img src="images/blog-img/post-img3.jpg" alt=""></div>
                                <div class="post-name">Post With a Photo  Gallery</div>
                                <div class="date">03 Jun 2014<span class="icon icon-comment"></span> 4 </div>
                                <p>Lorem Ipsum is simply dummy text of the printing and industry...</p>
                            </div>
                        </div>
                        <div class="subscribe-blog">
                        	<h3>Subscribe to Blog via Email</h3>
                            <div class="input-box">
                            	<input type="text" placeholder="First Name">
                            </div>
                            <div class="input-box">
                            	<input type="text" placeholder="Last Name">
                            </div>
                            <div class="input-box">
                            	<input type="text" placeholder="Email Address">
                            </div>
                            <div class="submit-box">
                            	<input type="submit" value="Submit" class="btn">
                            </div>
                        </div>
                        <div class="share-link">
                        	<h3>Connect</h3>
                            <ul>
                            	<li><a href="#"><span class="icon icon-facebook"></span></a></li>
                                <li><a href="#"><span class="icon icon-google-plus"></span></a></li>
                                <li><a href="#"><span class="icon icon-twitter"></span></a></li>
                                <li><a href="#"><span class="icon icon-wordpress"></span></a></li>
                                <li><a href="#"><span class="icon icon-linkedin"></span></a></li>
                                <li><a href="#"><span class="icon icon-instagram"></span></a></li>
                                <li><a href="#"><span class="icon icon-play-1"></span></a></li>
                                <li><a href="#"><span class="icon icon-vimeo"></span></a></li>
                            </ul>
                        </div>
                        <div class="search-box">
                        	<input type="text" placeholder="Search Here">
                            <input type="submit" value="">
                        </div>
                        <div class="flicker-view">
                        	<h3>Flicker</h3>
                            <div class="flicker-box"><img src="images/blog-img/flicker-img1.jpg" alt=""></div>
                            <div class="flicker-box"><img src="images/blog-img/flicker-img2.jpg" alt=""></div>
                            <div class="flicker-box"><img src="images/blog-img/flicker-img3.jpg" alt=""></div>
                            <div class="flicker-box"><img src="images/blog-img/flicker-img4.jpg" alt=""></div>
                            <div class="flicker-box"><img src="images/blog-img/flicker-img5.jpg" alt=""></div>
                            <div class="flicker-box"><img src="images/blog-img/flicker-img6.jpg" alt=""></div>
                            <div class="flicker-box"><img src="images/blog-img/flicker-img7.jpg" alt=""></div>
                            <div class="flicker-box"><img src="images/blog-img/flicker-img8.jpg" alt=""></div>
                            <div class="flicker-box"><img src="images/blog-img/flicker-img9.jpg" alt=""></div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
