@extends('adminlte::page')

@section('content_header')
<h1>Customer Details</h1>
@stop
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <a href="{{route('customers.index')}}">
            <h3 class="card-title">
                << Back </h3>
        </a>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#bookings" role="tab" aria-controls="contact" aria-selected="false">Bookings</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <br>
                <label class="col-sm-1 col-form-label">Name : </label> {{$customer->name}} <br />
                <label class="col-sm-1 col-form-label">Email : </label> {{$customer->email}} <br />
                <label class="col-sm-1 col-form-label">Status : </label> {{$customer->status==0 ? 'In-Active' : 'Active'}} <br />

            </div>
            <div class="tab-pane fade" id="bookings" role="tabpanel" aria-labelledby="contact-tab">
                <br />
                <div class="row">
                {{ Form::model($customer,['route' => ['customers.search', $customer->id], 'method' => 'get','id' => 'search-booking','enctype'=>"multipart/form-data"]) }}

            <div class="col-md-10" style="display: flex;">
                <div class="form-group" style="width: 200px;margin-right: 20px;">
                    <label><strong>Booking ID :</strong></label>
                    {{ Form::text('booking_id',isset($_GET['booking_id']) ? $_GET['booking_id'] : '', ['class' => 'form-control','id'=>'status', 'placeholder' =>'Booking Id']) }}
                </div>

                <div class="form-group" style="width: 200px;margin-right: 20px;">
                    <label><strong>Start Date :</strong></label>
                    {{ Form::text('start_date',isset($_GET['start_date']) ? $_GET['start_date'] : '', ['class' => 'form-control','id'=>'dt3', 'placeholder' =>'Start Date','autocomplete'=>'off']) }}
                </div>

                <div class="form-group" style="width: 200px;margin-right: 20px;">
                    <label><strong>End Date :</strong></label>
                    {{ Form::text('end_date',isset($_GET['end_date']) ? $_GET['end_date'] : '', ['class' => 'form-control','id'=>'dt4', 'placeholder' =>'End Date','autocomplete'=>'off']) }}
                </div>
                <div class="form-group" style="width: 150px;margin-top: 22px;">
                {{ Form::submit('Search', ['class' => 'btn btn-lg btn-warning']) }}
                </div>
                <div class="form-group" style="width: 150px;margin-top: 22px;">
                <a href="{{route('customers.show',$customer->id)}}"> {{ Form::button('Reset', ['class' => 'btn btn-lg btn-danger']) }}</a>

                </div>

            </div>
            {{ Form::close() }}

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Date</th>
                            <th>Booking ID</th>
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
                        @foreach($booking_list as $SingleBooking)
                        
                            @if($SingleBooking->status == 'failed')
                                @php $Status = 'bg-danger'; @endphp
                            @else
                                @php $Status = 'bg-success'; @endphp
                            @endif
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{ date('d M Y',strtotime($SingleBooking->date)) }}</td>
                            <td>{{$SingleBooking->booking_id }}</td>
                            <td>{{$SingleBooking->service->title }}</td>
                            <td>{{$SingleBooking->home_type->title}}</td>
                            <td>{{$SingleBooking->home_sub_type->title }}</td>
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

                @foreach($booking_list as $SingleBooking)

                <div class="modal fade" id="modal{{$SingleBooking->id}}" aria-modal="true" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content bg-secondary">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Booking ID : #{{$SingleBooking->booking_id}}</h4>
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
</div>
@stop