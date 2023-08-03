@extends('layouts.app')

@section('title', 'Services')

@section('content')
<section class="service-type">
    <div class="container">
        <div class="heading">
            <div class="icon"><em class="icon icon-heading-icon"></em></div>
            <div class="text">
            	<?php $category_id = $_GET['service_id']; ?>
                <h2>Find The {{ App\Category::where(['id'=>$category_id])->pluck('name')[0] }} You Need</h2>
            </div>
        </div>
        <div class="service-catagari">
            <ul>
            	@foreach(App\Category::where(['parent_id'=>$category_id])->orderBy('id', 'asc')->get() as $category)
                <li>
                    <a href="{{ url('organization',$category->id) }}">
                        <span><img src="images/categories/{{ $category->img }}"></span>
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
