@extends('layouts.app')

@section('title', 'Books')

@section('content')
<!-- breadcrumbs-area-start -->
<div class=" mb-20">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				
			</div>
		</div>
	</div>
</div>
<!-- breadcrumbs-area-end -->
<!-- shop-main-area-start -->
<div class="shop-main-area mb-70">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="section-title-5 mb-10">
					<h2>Search result</h2>
				</div>
				<!-- tab-area-start -->
				<div class="tab-content">
					<div class="tab-pane active" id="th">
					    <div class="row">
					    	<!-- books -->
					    	<?php $q = $_GET['q']; ?>
					    	@foreach(App\Book::where('title', 'LIKE', "%$q%")->orwhere('sub_title', 'LIKE', "%$q%")->orwhere('author', 'LIKE', "%$q%")->orderBy('id', 'desc')->orwhere('description', 'LIKE', "%$q%")->where(['id'=>1])->get() as $book)
					        <div class="col-lg-3 col-md-4 col-sm-6">
					            <!-- single-product-start -->
                                <div class="product-wrapper mb-40">
                                    <div class="product-img">
                                        <a href="{{ URL::to( '/book-details/' . $book->id) }}">
                                            <img src="images/books/{{$book->image1}}" alt="book" class="primary" />
                                        </a>
                                    </div>
                                    <div class="product-details text-center">
					                      <div class="product-rating">
					                          <h4><a href="{{ URL::to( '/book-details/' . $book->id) }}">{{$book->title}}</a></h4>
					                      </div>
					                </div>
	                            </div>
                                <!-- single-product-end -->
					        </div>
							@endforeach
							<!-- audios -->
							@foreach(App\Audio::where('title', 'LIKE', "%$q%")->orwhere('sub_title', 'LIKE', "%$q%")->orwhere('author', 'LIKE', "%$q%")->orderBy('id', 'desc')->orwhere('description', 'LIKE', "%$q%")->where(['id'=>1])->get() as $audio)
					        <div class="col-lg-3 col-md-4 col-sm-6">
					            <!-- single-product-start -->
                                <div class="product-wrapper mb-40">
                                    <div class="product-img">
                                        <a href="{{ URL::to( '/audio-details/' . $audio->id) }}">
                                            <img src="images/audios/{{$audio->image}}" alt="audio" class="primary" />
                                        </a>
                                    </div>
                                    <div class="product-details text-center">
					                      <div class="product-rating">
					                          <h4><a href="{{ URL::to( '/audio-details/' . $audio->id) }}">{{$audio->title}}</a></h4>
					                      </div>
					                </div>
	                            </div>
                                <!-- single-product-end -->
					        </div>
							@endforeach
							<!-- videos -->
							@foreach(App\Video::where('title', 'LIKE', "%$q%")->orwhere('sub_title', 'LIKE', "%$q%")->orwhere('author', 'LIKE', "%$q%")->orderBy('id', 'desc')->orwhere('description', 'LIKE', "%$q%")->where(['id'=>1])->get() as $video)
					        <div class="col-lg-3 col-md-4 col-sm-6">
					            <!-- single-product-start -->
                                <div class="product-wrapper mb-40">
                                    <div class="product-img">
                                        <a href="{{ URL::to( '/video-details/' . $video->id) }}">
                                            <img src="images/videos/{{$video->image}}" alt="video" class="primary" />
                                        </a>
                                    </div>
                                    <div class="product-details text-center">
					                      <div class="product-rating">
					                          <h4><a href="{{ URL::to( '/video-details/' . $video->id) }}">{{$video->title}}</a></h4>
					                      </div>
					                </div>
	                            </div>
                                <!-- single-product-end -->
					        </div>
							@endforeach

					    </div>
					</div>
				</div>
				<!-- tab-area-end -->
				<!-- pagination-area-start -->
				<div class="pagination-area mt-50">
					<div class="list-page-2">
						<!-- <p>Items 1-9 of 11</p> -->
					</div>
					<div class="page-number">
						<ul>
							<!-- pagination -->
						</ul>
					</div>
				</div>
				<!-- pagination-area-end -->
			</div>
		</div>
	</div>
</div>
<!-- shop-main-area-end -->
@endsection
