@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1 class="m-0">Dashboard</h1>
@stop

@section('content')

<div class="row">
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">No. of Bookings</span>
        <span class="info-box-number">
          {{$Countbookings}}
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
        <span class="info-box-number">{{$Countcustomers}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">No. of Maids</span>
        <span class="info-box-number">{{$Countmaids}}</span>
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
        <span class="info-box-text">Payment</span>
        <span class="info-box-number">${{$Sumbookings}}</span>
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
                    @php $i=1; $Status;@endphp
                    @foreach($todaybookings as $SingleBooking)

                    @if($SingleBooking->status == 'failed')
                    @php $Status = 'bg-danger'; @endphp
                    @else
                    @php $Status = 'bg-success'; @endphp
                    @endif
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{ date('d M Y',strtotime($SingleBooking->booking_date)) }}</td>
                        <td>{{$SingleBooking->booking_id }}</td>
                        <td>{{ ucfirst($SingleBooking->customer->name) }}</td>
                        <td>{{$SingleBooking->service->title }}</td>
                        <td>{{$SingleBooking->home_type->title}}</td>
                        <td>{{isset($SingleBooking->home_sub_type->title) ? $SingleBooking->home_sub_type->title : ''  }}</td>
                        <td>{{$SingleBooking->schedule_type }}</td>
                        <td>${{$SingleBooking->total_price }}</td>
                        <td>
                            <span class="badge {{$Status}}">{{$SingleBooking->status }}</span>
                        </td>
                        <td><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal{{$SingleBooking->id}}">Show Details</button>
                        </td>
                    </tr>
                    @php $i++; @endphp
                    @endforeach
                </tbody>
            </table>

            <span>{{$todaybookings->links()}}</span>

            @foreach($todaybookings as $SingleBooking)

            <div class="modal fade" id="modal{{$SingleBooking->id}}" aria-modal="true" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content bg-secondary">
                        <div class="modal-header">
                            <h6 class="modal-title">Booking ID : #{{$SingleBooking->booking_id}}</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Extra Service</th>
                                        <th>Quantity</th>
                                        <th>Base Price</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($SingleBooking->items as $Item)
                                    <tr>
                                        <td>{{$Item->extra_service->title }}</td>
                                        <td>{{$Item->qty}}</td>
                                        <td>${{$Item->base_price }}</td>
                                        <td>${{$Item->price }}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <h3>Total Price : ${{$SingleBooking->total_price}}</h3>
                    </div>

                </div>

            </div>
            @endforeach

        </div>
  </div>
</div>

@stop