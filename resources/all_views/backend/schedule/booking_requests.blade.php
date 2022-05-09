@extends('adminlte::page')

@section('content_header')
<h1>Booking Requests</h1>
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">List of Booking Requests</h3>
    </div>
    <div class="card-body">
    @include("backend.alerts.success")
    @include("backend.alerts.error")
        <div class="table-responsive dt-responsive">
            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Customer Location</th>
                        <th>Service Type</th>
                        <th>Home Type</th>
                        <th>Home Sub Type</th>
                        <th>Time Slot</th>
                        <th>Total Hours</th>
                        <th>Total Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1; @endphp
                    @forelse($booking_requests as $booking_request)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{ date('d M, Y',strtotime($booking_request->maid_time_slot->date)) }}</td>
                        <td>{{$booking_request->booking_details->customer->city.', '.$booking_request->booking_details->customer->state.', '.$booking_request->booking_details->customer->suite.', '.$booking_request->booking_details->customer->zipcode}}</td>
                        <td>{{$booking_request->booking_details->service->title}}</td>
                        <td>{{$booking_request->booking_details->home_type->title}}</td>
                        <td>{{isset($booking_request->booking_details->home_sub_type->title) ? $booking_request->booking_details->home_sub_type->title : '--' }}</td>
                        <td>{{ $booking_request->maid_time_slot->timeSlot->slot }}</td>
                        <td>{{ $booking_request->calculateTotalTime($booking_request->booking_details,$booking_request->booking_details) }}</td>
                        <td>${{ $booking_request->booking_details->total_price }}</td>
                        <td>
                            @if($booking_request->status==1)
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#modal{{$booking_request->id}}" class="btn btn-warning btn-mini">Accept</a>
                            <a href="javascript:void(0)" data-request="{{$booking_request->id}}" data-status="3" data-type="Declined" class="btn btn-danger btn-mini booking_request_action">Decline</a>
                            @elseif($booking_request->status==2)
                            <a href="javascript:void(0)" class="btn btn-success btn-mini">Accepted</a>
                            <a href="javascript:void(0)" class="btn btn-info btn-mini" data-toggle="modal" data-target="#viewDetailsModal{{$booking_request->id}}">View Details</a>
                            @elseif($booking_request->status==3)
                            <a href="javascript:void(0)" class="btn btn-danger btn-mini">Declined</a>
                            @elseif($booking_request->status==4)
                            <a href="javascript:void(0)" class="btn btn-success btn-mini">Finally Accepted</a>
                            <a href="javascript:void(0)" class="btn btn-info btn-mini" data-toggle="modal" data-target="#viewDetailsModal{{$booking_request->id}}">View Details</a>
                            @elseif($booking_request->status==5)
                            <a href="javascript:void(0)" class="btn btn-danger btn-mini">Decline at the moment</a>
                            <a href="javascript:void(0)" class="btn btn-info btn-mini" data-toggle="modal" data-target="#viewDetailsModal{{$booking_request->id}}">View Details</a>
                            @elseif($booking_request->status==6)
                            <a href="javascript:void(0)" class="btn btn-success btn-mini">Completed</a>
                            <a href="javascript:void(0)" class="btn btn-info btn-mini" data-toggle="modal" data-target="#viewDetailsModal{{$booking_request->id}}">View Details</a>
                            @elseif($booking_request->status==7)
                            <a href="javascript:void(0)" class="btn btn-warning btn-mini">Not Fully Completed</a>
                            <a href="javascript:void(0)" class="btn btn-info btn-mini" data-toggle="modal" data-target="#viewDetailsModal{{$booking_request->id}}">View Details</a>
                            @elseif($booking_request->status==8)
                            <a href="javascript:void(0)" class="btn btn-danger btn-mini">Accepted by other</a>
                            @endif
                        </td>
                    </tr>

                    <div class="modal fade" id="modal{{$booking_request->id}}" aria-modal="true" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content bg-secondary">
                                <div class="modal-header">
                                    <h6 class="modal-title">Booking Request : #{{$i}}</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <label>Arrive Date</label>
                                    {{ Form::date('date',$booking_request->maid_time_slot->date, ['class' => 'form-control', 'placeholder' =>'Date','id'=>'arrive_date'.$booking_request->id, 'readonly' => 'readonly']) }}
                                    <label>Time Slot</label>
                                    {{ Form::text('time_slot',$booking_request->maid_time_slot->timeSlot->slot, ['class' => 'form-control', 'disabled' => 'disabled']) }}
                                    <br>
                                    <label>Arrive Time</label>
                                    {{ Form::text('time',old('time'), ['class' => 'form-control clock', 'placeholder' =>'Time','id'=>'arrive_time'.$booking_request->id, 'required' => 'required']) }}

                                    {{ Form::textarea('special_instructions',old('special_instructions'), ['class' => 'form-control', 'placeholder' =>'Special Instructions','id'=>'special_instructions'.$booking_request->id, 'required' => 'required']) }}
                                    <br>
                                    <a href="javascript:void(0)" data-request="{{$booking_request->id}}" data-status="2" data-type="Accepted" data-toggle="modal" class="btn btn-warning btn-mini booking_request_action">Accept</a>
                                    <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-danger btn-mini close">Cancel</a>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="modal fade" id="viewDetailsModal{{$booking_request->id}}" aria-modal="true" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content bg-secondary">
                                <div class="modal-header">
                                    <h6 class="modal-title">Booking Request : #{{$i}}</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Date - {{ date('d M, Y',strtotime($booking_request->maid_time_slot->date)) }}</p>
                                    <p>Customer Name - {{ $booking_request->booking_details->customer->name }}</p>
                                    <p>Customer Email - {{ $booking_request->booking_details->customer->email }}</p>
                                    <p>Customer Phone - {{ $booking_request->booking_details->customer->phone }}</p>
                                    <p>Address - {{$booking_request->booking_details->customer->city.', '.$booking_request->booking_details->customer->state.', '.$booking_request->booking_details->customer->suite.', '.$booking_request->booking_details->customer->zipcode}}</p>
                                    <p>Service - {{$booking_request->booking_details->service->title}}</p>
                                    <p>Home Type - {{$booking_request->booking_details->home_type->title}}</p>
                                    <p>Home Sub Type - {{isset($booking_request->booking_details->home_sub_type->title) ? $booking_request->booking_details->home_sub_type->title : '--' }}</td>
                                    <p>Time Slot - {{ isset($booking_request->maid_time_slot->timeSlot->slot) ? $booking_request->maid_time_slot->timeSlot->slot : '' }}</p>
                                    <p>Total Hours - {{ isset($booking_request->booking_details->home_type->hours) ? $booking_request->calculateTotalTime($booking_request->booking_details) : '--' }}</p>
                                    <p>Arrive Date - {{ isset($booking_request->arrive_date) ? date('d M, Y',strtotime($booking_request->arrive_date)) : '' }}</p>
                                    <p>Arrive Time - {{ isset($booking_request->arrive_time) ? $booking_request->arrive_time : ''  }}</p>
                                    <div class='rating-stars text-center'>
                                        <ul class='stars'>
                                            @if($booking_request->rating==1)
                                            <li class='star selected' title='Poor' data-value='1'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='Fair' data-value='2'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='Good' data-value='3'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='Excellent' data-value='4'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='WOW!!!' data-value='5'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            @elseif($booking_request->rating==2)
                                            <li class='star selected' title='Poor' data-value='1'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star selected' title='Fair' data-value='2'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='Good' data-value='3'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='Excellent' data-value='4'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='WOW!!!' data-value='5'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>

                                            @elseif($booking_request->rating==3)
                                            <li class='star selected' title='Poor' data-value='1'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star selected' title='Fair' data-value='2'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star selected' title='Good' data-value='3'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='Excellent' data-value='4'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='WOW!!!' data-value='5'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>

                                            @elseif($booking_request->rating==4)
                                            <li class='star selected' title='Poor' data-value='1'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star selected' title='Fair' data-value='2'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star selected' title='Good' data-value='3'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star selected' title='Excellent' data-value='4'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='WOW!!!' data-value='5'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            @elseif($booking_request->rating==5)
                                            <li class='star selected' title='Poor' data-value='1'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star selected' title='Fair' data-value='2'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star selected' title='Good' data-value='3'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star selected' title='Excellent' data-value='4'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star selected' title='WOW!!!' data-value='5'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                    @if(isset($booking_request->review_by_customer))
                                    <textarea class="form-control" disabled>{{$booking_request->review_by_customer}}</textarea>
                                    @endif
                                </div>
                            </div>

                        </div>

                    </div>
                    @php $i++ @endphp
                    @empty

                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>
</div>
<style>
    .rating-stars ul {
        list-style-type: none;
        padding: 0;

        -moz-user-select: none;
        -webkit-user-select: none;
    }

    .rating-stars ul>li.star {
        display: inline-block;

    }

    /* Idle State of the stars */
    .rating-stars ul>li.star>i.fa {
        font-size: 2.5em;
        /* Change the size of the stars */
        color: #ccc;
        /* Color on idle state */
    }

    /* Hover state of the stars */
    .rating-stars ul>li.star.hover>i.fa {
        color: #FFCC36;
    }

    /* Selected state of the stars */
    .rating-stars ul>li.star.selected>i.fa {
        color: #FF912C;
    }
</style>

@stop