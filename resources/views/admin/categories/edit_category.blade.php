@extends('layouts.admin_layout')

@section('title', 'Edit category')
@section('css_content')
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('backend/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('backend/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('backend/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('backend/dist/css/skins/_all-skins.min.css') }}">

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
        <li class="active">Edit category</li>

      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Main row -->
<div class="row">
  <div class="col-sm-6">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Edit category</h3>
      </div>
      <div class="col-md-12">
          
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
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" method="POST" action="{{ url('/admin/edit-category/'.$categoryDetails->id) }}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="col-form-label">Category Name</label>
                <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Category Name" value="{{ $categoryDetails->name }}" required>
                <span class="messages"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <div class="form-group">
                  <label>Category Level</label>
                  <select class="form-control select2" name="parent_id" style="width: 100%;">
                    <option selected="selected" value="0">Main category</option>
                    @foreach($levels as $level)
                    <option value="{{ $level->id }}"  <?php if($level->id == $categoryDetails->parent_id){ echo 'selected';} ?> >{{ $level->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="col-form-label">Image</label>
                  <input type="file" class="form-control-file" id="img" name="img">
                  <span class="messages"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="col-form-label">Description</label>
                  <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="{{ $categoryDetails->description }}" required>
                  <span class="messages"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="col-form-label">URL</label>
                  <input type="text" class="form-control" id="url" name="url" placeholder="URL" value="{{ $categoryDetails->url }}" required>
                  <span class="messages"></span>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-success m-b-0">Update</button>
        </div>
      </form>
    </div>
  </div>

</div>
<!-- /.row (main row) -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
    
@endsection
@section('js_content')
<!-- jQuery 3 -->
<script src="{{ asset('backend/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('backend/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('backend/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend/dist/js/demo.js') }}"></script>
@endsection