@extends('adminlte::page')

@section('title', 'Every Home')

@section('content_header')
<h1 class="m-0">Dashboard</h1>
@stop

@section('content')

<div class="row">
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-plus"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">No. of Requests</span>
        <span class="info-box-number">
          
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">No. of Bookings</span>
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
        <span class="info-box-text">No. of Customers</span>
        <span class="info-box-number"></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- fix for small devices only -->
  <div class="clearfix hidden-md-up"></div>

  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Payment</span>
        <span class="info-box-number"></span>
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
      Today Bookings
    </h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
  <div class="table-responsive dt-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Date</th>
                        <th>Booking ID</th>
                        <th>Customer</th>
                        <th>Service</th>
                        <th>Home Type</th>
                        <th>Home Sub Type</th>
                        <th>Schedule Type</th>
                        <th>Total Price</th>
                        <th style="width: 40px">Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  
                </tbody>
            </table>

        </div>
  </div>
</div>

@stop