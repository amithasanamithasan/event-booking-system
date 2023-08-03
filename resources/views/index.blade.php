@extends('layouts.app')

@section('title', 'Home')

@section('content')
  <section class="banner">
    <div class="carousel" id="mainBnner">
        <div class="item"><img src="{{ asset('frontend/images/banner-img/slider-img.jpg') }}" alt=""></div>
        <div class="item"><img src="{{ asset('frontend/images/banner-img/slider-img2.jpg') }}" alt=""></div>
        <div class="item"><img src="{{ asset('frontend/images/banner-img/slider-img3.jpg') }}" alt=""></div>
    </div>
    <div class="banner-nav">
        <div class="prev"><span class="icon icon-arrow-left"></span></div>
        <div class="next"><span class="icon icon-arrow-right"></span></div>
    </div>
    <div class="banner-text">
      <div class="search-title">
        <h1> Every Event Should be  <span>Perfect</span></h1>
      </div>
      <div class="container">
      </div>
    </div>
</section>
<section class="service-type">
    <div class="container">
        <div class="heading">
            <div class="icon"><em class="icon icon-heading-icon"></em></div>
            <div class="text">
                <h2>Our Services</h2>
            </div>
            <div class="info-text">We Organize All Events Carefully.</div>
        </div>
        <div class="service-catagari">
            <ul>
                @foreach(App\Category::where(['parent_id'=>0])->orderBy('id', 'desc')->get() as $category)
                <li>
                    <a href="services?service_id=<?php print $category->id; ?>">
                        <!-- <span class="icon icon-caterers"></span> -->
                        <span class="text">{{ $category->name }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
    
        </div>
    </div>
</section>
<section class="content">
    <div class="container">
        <div class="home-event">
            <div class="heading">
                <div class="icon"><em class="icon icon-heading-icon"></em></div>
                <div class="text">
                    <h2>Recent Events</h2>
                </div>
                <div class="info-text">It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</div>
            </div>
            <div class="row">
                <div class="event-slider">
                    @foreach(App\Events::orderBy('id', 'desc')->limit(6)->get() as $event)
                    <div class="item">
                        <div class="event-box">
                            <div class="img">
                                <a href="#">
                                    <img src="../images/events/{{$event->image}}" alt="">
                                    <span class="capsan">
                                        <span>{{ App\Category::where(['id'=>$event->category_id])->pluck('name')[0] }}</span>
                                    </span>
                                </a>
                            </div>
                            <div class="name">{{ App\Category::where(['id'=>$event->category_id])->pluck('name')[0] }}</div>
                            <p>{{ $event->title }}</</p>
                            <a href="{{ url('event-details',$event->id) }}">Readmore</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
