@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1 class="m-0">Dashboard</h1>
@stop

@section('content')

<div class="row">
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-microchip"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">No. of Customers</span>
        <span class="info-box-number">
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">No. of Bookings</span>
        <span class="info-box-number"></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Likes</span>
        <span class="info-box-number">0</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <!-- fix for small devices only -->
  <div class="clearfix hidden-md-up"></div>

  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Sales</span>
        <span class="info-box-number">$0</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <!-- /.col -->
</div>

<div class="card">
  <div class="card-header ui-sortable-handle" style="cursor: move;">
    <h3 class="card-title">
      <i class="ion ion-clipboard mr-1"></i>
      To Do List
    </h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <ul class="todo-list ui-sortable" data-widget="todo-list">


      <li class="">
        <!-- drag handle -->
        <span class="handle ui-sortable-handle">
          <i class="fas fa-ellipsis-v"></i>
          <i class="fas fa-ellipsis-v"></i>
        </span>
        <!-- checkbox -->
        <div class="icheck-primary d-inline ml-2">
          <label for="todoCheck1"></label>
        </div>
        <!-- Emphasis label -->
        <small class="badge badge-danger"></small>
        <!-- todo text -->
        <span class="text"></span>
      </li>
     
    </ul>
  </div>
</div>

@stop