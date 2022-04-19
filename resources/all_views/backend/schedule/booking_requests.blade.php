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
                        <td>{{ $booking_request->booking_details->home_type->hours }}</td>
                        <td>
                            @if($booking_request->status==1)
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#modal{{$booking_request->id}}" class="btn btn-warning btn-mini">Accept</a>
                            <a href="javascript:void(0)" data-request="{{$booking_request->id}}" data-status="3" data-type="Declined" class="btn btn-danger btn-mini booking_request_action">Decline</a>
                            @elseif($booking_request->status==2)
                            <a href="javascript:void(0)" class="btn btn-success btn-mini">Accepted</a>
                            <a href="javascript:void(0)" class="btn btn-info btn-mini" data-toggle="modal" data-target="#viewDetailsModal{{$booking_request->id}}">View Details</a>
                            @elseif($booking_request->status==3)
                            <a href="javascript:void(0)" class="btn btn-danger btn-mini">Declined</a>
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
                                    <label>Arrive Time</label>
                                    {{ Form::time('time',old('time'), ['class' => 'form-control', 'placeholder' =>'Time','id'=>'arrive_time'.$booking_request->id, 'required' => 'required']) }}
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
                                    <p>Time Slot - {{ $booking_request->maid_time_slot->timeSlot->slot }}</p>
                                    <p>Total Hours - {{ $booking_request->booking_details->home_type->hours }}</p>
                                    <p>Arrive Date - {{ date('d M, Y',strtotime($booking_request->arrive_date)) }}</p>
                                    <p>Arrive Time - {{ $booking_request->arrive_time }}</p>
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

@stop