@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<section class="page-header">
    <div class="container">
    	<h1>About us</h1>
    </div>
</section>
<section class="content">
    <div class="container">
        <div class="home-event">
            <div class="heading">
            	<div class="icon"><em class="icon icon-heading-icon"></em></div>
                <div class="text">
                    <h2>About</h2>
                </div>
                <div class="info-text">All the information you will need is listed below, just click on the page you want to view and that's it.</div>
                <div class="stickLine"></div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                    	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam elementum nisi eget mi mollis laoreet. Morbi non dignissim tellus, vitae blandit urna Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi non dignissim. Nullam elementum nisi eget mi mollis laoreet. Morbi non dignissim tellus, vitae blandit urna Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi non dignissim.Nullam elementum nisi eget mi mollis laoreet. Morbi non dignissim tellus, vitae blandit urna Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi non dignissim.</p>
                    </div>
                </div>
                <div class="heading">
	            	<div class="icon"><em class="icon icon-heading-icon"></em></div>
	                <div class="text">
	                    <h2>Contact info</h2>
	                </div>
	            </div>
                <div class="col-sm-4">
                    <div class="contact-box">
                        <div class="contactIcon">
                            <span class="icon icon-phone"></span>
                        </div>
                        <a href="telTo:4408007654321">+44 (0) 800 765 4321</a>
                        <a href="telTo:44047856977145">+44 (0) 47856977145</a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact-box">
                        <div class="contactIcon">
                        	<span class="icon icon-location-1"></span>
                        </div>
                    	<address>No.200 Joseph Road, 74 West Main Street,Oyster Bay, 350 Fifth Avenue, 34th floor New York, NY 10118-3299 USA</address>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact-box">
                        <div class="contactIcon">
                            <span class="icon icon-message"></span>
                        </div>
                        <span>Email - <a href="mailTo:info@eventplanning.com">info@eventplanning.com</a></span>
                        <span>Website - <a href="#">eventplanning.com</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="map" id="map">
    
</section>
<section class="contackForm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
            	<h2>Contact Form</h2>
            </div>
            <form class="has-validation-callback" action="" method="post">
                <div class="col-sm-6">
                	<div class="input-box">
                        <label>Your Name <sup>*</sup></label>
                        <input type="text" data-validation="required" data-validation-error-msg="Name cannot be blank." name="name">
                    </div>
                    <div class="input-box">
                        <label>Your Email <sup>*</sup></label>
                        <input type="text" data-validation="email" data-validation-error-msg="Incorrect e-mail address" name="email">
                    </div>
                    <div class="input-box">
                        <label>Subject <sup>*</sup></label>
                        <input type="text" data-validation="required" data-validation-error-msg="Subject cannot be blank." name="subject">
                    </div>
                </div>
                <div class="col-sm-6">
                	<div class="input-box">
                        <label>Your Message <sup>*</sup></label>
                        <textarea data-validation="required" data-validation-error-msg="Message cannot be blank." name="message"></textarea>
                    </div>
                    <input type="submit" class="btn" value="Submit">
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
