@extends('layouts.app')

@section('title', 'Organizer')

@section('content')
<div class="searchFilter-main">
    <section class="content">
        <div class="breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="#">Service</a>/</li>
                    <li class="active"><a href="#"><?php print_r($org_type); ?></a></li>
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="venues-view">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="left-side">
                            <div class="left-link">
                                <h2>People also viewed...</h2>
                                <ul>
                                    @foreach(App\Category::where('parent_id','!=',0)->orderBy('id', 'desc')->get() as $category)
                                    <li><a href="/organization/<?php print $category->id; ?>"><span class="icon icon-arrow-right"></span>{{ $category->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="left-productBox hidden-sm">
                                <h2>Featured Events</h2>
                                @foreach(App\Events::orderBy('id', 'desc')->limit(2)->get() as $event)
                                <div class="product-img"><img src="../images/events/{{$event->image}}" alt=""></div>
                                <h3>{{ $event->title }}</h3>
                                <p>{{ $event->sub_title }}</p>
                                <a href="{{ url('event-details',$event->id) }}">Vewi all Details <span class="icon icon-arrow-right"></span></a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-lg-9 col-sm-12">
                        <div class="right-side">
                            <div class="toolbar">
                                <div class="finde-count"><?php print_r($org_type); ?></div>
                            </div>
                            @foreach($events as $event)
                            <div class="venues-slide">
                                <div class="img"><img src="../images/events/{{$event->image}}" alt=""></div>
                                <div class="text">
                                    <h3>{{ $event->title }}</h3>
                                    <div class="address">{{$event->sub_title}}</div>
                                    <div class="reviews"></div>
                                    <div class="outher-info">
                                        {{$event->location}}
                                    </div>
                                    <div class="outher-link">
                                        <ul>
                                        	<li><a href="#"><span class="icon icon-calander-check"></span>Check Availability</a></li>
                                            <li><a href="#"><span class="icon icon-info"></span>{{ App\User::where(['id'=>$event->posted_by_id])->pluck('name')[0] }}</a></li>
                                            <li><a href="javascript:;"><span class="icon icon-phone"></span>{{ App\User::where(['id'=>$event->posted_by_id])->pluck('phone')[0] }}</a></li>
                                        </ul>
                                    </div>
                                    <div class="button">
                                        <a href="{{ url('event-details',$event->id) }}" class="btn">Book Now</a>
                                        <a href="javascript:;" class="btn gray">View Details <span class="icon icon-arrow-down"></span></a>
                                    </div>
                                </div>
                                <div class="amenities-view">
                                	{!! $event->description !!}
                                </div>
                            </div>
                            @endforeach
                            {{ $events->links() }}
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
