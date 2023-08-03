@extends('layouts.app')

@section('title', 'Event Details')

@section('content')
<section class="content">
	<div class="search-resultPage">
        <div class="container">
    	   @if(Session::has('event_flash_success'))
            <div class="alert alert-success alert-dismissible fade in"  id="myAlert">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>{!! session('event_flash_success') !!} !</strong>
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

        	<div class="row">
            	<div class="col-lg-9 col-sm-9 col-md-9">
                	<div class="hotel-info tab-content">
                    	<h2>{{ $event->title }}</h2>
                        <div class="inner-info">
                            <h4>{{$event->sub_title}}</h4>
                            
                            <div class="address">
                                <div class="map-view">
                                    <img src="../images/events/{{$event->image}}" alt="">
                                    <!-- <div class="link"><a href="#">See Location</a></div> -->
                                </div>
                                <div class="address-view">
                                    <h3>Address :</h3>
                                    <div class="address-slide full">
                                        <div class="icon icon-location-2"></div>
                                        <label>{{$event->location}}</label>
                                    </div>
                                    <h3>Organization info :</h3>
                                    <div class="address-slide">
                                        <div class="icon icon-info"></div>
                                        <label>{{ App\User::where(['id'=>$event->posted_by_id])->pluck('name')[0] }}</label>
                                    </div>
                                    <div class="address-slide">
                                        <div class="icon icon-message"></div>
                                        <label>{{ App\User::where(['id'=>$event->posted_by_id])->pluck('email')[0] }}</label>
                                    </div>
                                    <div class="address-slide">
                                        <div class="icon icon-phone"></div>
                                        <label>{{ App\User::where(['id'=>$event->posted_by_id])->pluck('phone')[0] }}</label>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="amenities-list tab-content">
                    	<h2>Details </h2>
                        <div class="amenities-view">
                        	{!! $event->description !!}
                        </div>
                    </div>
                </div>
                <div class="col-log-3 col-sm-3 col-md-3">
	                <div class="booking-formMain">
		                <div class="book-title">Enter Booking Details </div>	
		                <div class="book-form">
		                    <div class="row">
		                    	<form action="{{ url('/booking') }}" method="post">
		                    		{{csrf_field()}}
			                        <div class="col-sm-12">
			                            <div class="input-box has-error">
			                            	<input type="hidden" name="event_id" value="{{ $event->id }}">
			                                <input type="text" name="name" placeholder="Name" required="Fill up this field">
			                                <div class="help-block">Date and mobile cannot be blank.</div>
			                            </div>
			                        </div>
			                        <div class="col-sm-12">
			                            <div class="input-box">
			                                <input type="text" name="email" placeholder="Email">
			                            </div>
			                        </div>
			                        <div class="col-sm-12">
			                            <div class="input-box">
			                                <input type="text" name="phone" placeholder="Mobile" required="Fill up this field">
			                            </div>
			                        </div>
			                        <div class="col-sm-12 col-lg-6">
			                            <div class="input-box">
			                                <input type="date" name="date" placeholder="Date">
			                            </div>
			                        </div>
			                        <div class="col-sm-12 col-lg-6">
			                            <div class="input-box">
			                                <input type="text" name="time" placeholder="Time">
			                            </div>
			                        </div>
			                        <div class="col-sm-12 col-lg-6">
			                            <div class="input-box">
			                                <input type="text" name="min_guest" placeholder="Min Guest">
			                            </div>
			                        </div>
			                        <div class="col-sm-12 col-lg-6">
			                            <div class="input-box">
			                                <input type="text" name="max_guest" placeholder="Max Guest">
			                            </div>
			                        </div>
			                        <div class="col-sm-12">
			                            <div class="input-box">
			                            	<textarea style="width: 100%" name="note" placeholder="Special Instruction"></textarea>
			                            </div>
			                        </div>
			                        <div class="col-sm-12">
			                            <div class="submit-box">
			                                <input type="submit" value="Book Now" class="btn">
			                            </div>
			                        </div>
		                        </form>
		                    </div>
		                </div>
	                </div>
                </div>
            </div>

            <div class="modal modal-vcenter fade" id="seatingModal" tabindex="-1" role="dialog">
                <div class="modal-dialog seating-popup" role="document">
                	<div class="modal-content">
                    	<div class="close-icon" aria-label="Close" data-dismiss="modal" ><img src="images/close-icon.png" alt=""></div>
                        <h1>Seating Availability</h1>
                        <div class="facility-view">
                            <div class="facility-box">
                            	<div class="inner-box">
                                    <div class="radio-icon"></div>
                                    <div class="icon icon-theater"></div>
                                    <div class="name">Theatre</div>
                                    <div class="count">500</div>
                                </div>
                            </div>
                            <div class="facility-box">
                            	<div class="inner-box">
                                    <div class="radio-icon"></div>
                                    <div class="icon icon-classroom"></div>
                                    <div class="name">Classroom</div>
                                    <div class="count">250</div>
                                </div>
                            </div>
                            <div class="facility-box">
                            	<div class="inner-box">
                                    <div class="radio-icon"></div>
                                    <div class="icon icon-banquet"></div>
                                    <div class="name">Banquet</div>
                                    <div class="count">140</div>
                                </div>
                            </div>
                            <div class="facility-box">
                            	<div class="inner-box">
                                    <div class="radio-icon"></div>
                                    <div class="icon icon-u-shape"></div>
                                    <div class="name">U-Shape</div>
                                    <div class="count">120</div>
                                </div>
                            </div>
                            <div class="facility-box">
                            	<div class="inner-box">
                                    <div class="radio-icon"></div>
                                    <div class="icon icon-reception"></div>
                                    <div class="name">Reception</div>
                                    <div class="count">1000</div>
                                </div>
                            </div>
                            <div class="facility-box active">
                            	<div class="inner-box">
                                    <div class="radio-icon"></div>
                                    <div class="icon icon-boardroom"></div>
                                    <div class="name">Boardroom</div>
                                    <div class="count">10</div>
                                </div>
                            </div>
                        </div>
                        <div class="select-btn"><a href="javascript:;" class="btn">select</a></div>
        			</div>    
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
