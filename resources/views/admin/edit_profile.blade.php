@extends('layouts.admin_layout')

@section('title', 'Setting')
@section('css_content')
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('backend/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('backend/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('backend/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('backend/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('backend/dist/css/skins/_all-skins.min.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset('backend/bower_components/morris.js/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('backend/bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{asset('backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('backend/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

@endsection

@section('main_content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      @if(Route::current()->getName() == 'admin.change.password')
      <li class="active">Change password</li>
      @endif
      @if(Route::current()->getName() == 'admin.edit.profile')
      <li class="active">Edit profile</li>
      @endif
    </ol>
  </section>

<!-- Main content -->
<section class="content">

  <!-- Main row -->
  <div class="row">
    @if(Route::current()->getName() == 'admin.change.password')
    <div class="col-sm-6">
      <div class="box box-primary">
        
        <div class="box-header with-border">
          <h3 class="box-title">Change password</h3>
        </div>
        <div class="col-md-12">
          @if(Session::has('flash_message_error'))
          <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{!! session('flash_message_error') !!}</strong>
          </div>
          @endif
          @if(Session::has('flash_message_success'))
          <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{!! session('flash_message_success') !!}</strong>
          </div>
          @endif
          @if ($errors->any())
          <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
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
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{ route('admin.change.password.submit') }}">
          {{csrf_field()}}
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="col-form-label">Current Password</label>
                    <input type="password" class="form-control" name="current_pwd" id="current_pwd" placeholder="Current Password" required>
                    <span id="chkPwd"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="col-form-label">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" required>
                    <span class="messages"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="col-form-label">Repeat Password</label>
                    <input type="password" class="form-control" id="repeat_password" name="repeat_password" placeholder="Repeat Password" required>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" id="update" class="btn btn-primary m-b-0">Update password</button>
          </div>
        </form>
      </div>
    </div>
    @endif

    @if(Route::current()->getName() == 'admin.edit.profile')
    <div class="col-sm-6">
      <div class="box box-success">
        
    <div class="box-header with-border">
      <h3 class="box-title">Edit prfile</h3>
    </div>
    <!-- /.box-header -->
    <div class="col-md-12">
        @if(Session::has('edit_profile_flash_error'))
        <div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>{!! session('edit_profile_flash_error') !!} !</strong>
        </div>
        @endif
        @if(Session::has('edit_profile_flash_success'))
        <div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>{!! session('edit_profile_flash_success') !!} !</strong>
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
    <!-- form start -->
    <form role="form" method="POST" action="{{ route('admin.update_profile.submit') }}" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label">Name</label>
              <input type="hidden" class="form-control" name="id" id="id" placeholder="Name" value="{{ Auth::user()->id }}" required>
              <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ Auth::user()->name }}" required>
                
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label">Job title</label>
                <input type="text" class="form-control" id="job_title" name="job_title" placeholder="Job title" value="{{ Auth::user()->job_title }}" required>
                <span class="messages"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ Auth::user()->email }}" required>
                <span class="messages"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label">Image</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" id="update_profile" class="btn btn-success m-b-0">Update profile</button>
      </div>
    </form>
  </div>
</div>
@endif
</div>
<!-- /.row (main row) -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
    
@endsection
@section('js_content')
    <!-- jQuery 3 -->
    <script src="{{asset('backend/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('backend/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('backend/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Morris.js charts -->
    <script src="{{asset('backend/bower_components/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('backend/bower_components/morris.js/morris.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('backend/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
    <!-- jvectormap -->
    <script src="{{asset('backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{asset('backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('backend/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('backend/bower_components/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('backend/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- datepicker -->
    <script src="{{asset('backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <!-- Slimscroll -->
    <script src="{{asset('backend/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('backend/bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('backend/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('backend/dist/js/pages/dashboard.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('backend/dist/js/demo.js')}}"></script>
    <script type="text/javascript">
      $( document ).ready(function() {
          $( "#new_password" ).click(function() {
            var current_pwd = $('#current_pwd').val();
            $.ajax({
              type:"GET",
              url: "/admin/check-password",
              cache: false,
              data:{
                  current_pwd:current_pwd
              },
              success: function(result){
                  //if the result is true  
                  if(result == "false"){  
                      //show that the current pass is false  
                      $('#current_pwd').css('border', '1px solid red');
                      $('#chkPwd').html("<font color='red'>Current password is incorrect</font>");
                  }else if(result == "true"){  
                      //show that the current pass is true  
                      $('#current_pwd').css('border', '1px solid green');
                      $('#chkPwd').html("<font color='green'>Current password is correct</font>"); 
                  }  
                  // alert(result);
              },
              error:function(){
                alert('error');
              }
          });
        });
      });
    </script>
@endsection