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
                    <a href="javascript:void(0)" data-request="{{$booking_request->id}}" data-status="2"  data-type="Accepted" class="btn btn-warning btn-mini booking_request_action">Accept</a>
                    <a href="javascript:void(0)" data-request="{{$booking_request->id}}" data-status="3" data-type="Declined" class="btn btn-danger btn-mini booking_request_action">Decline</a>
                    @elseif($booking_request->status==2)
                    <a href="javascript:void(0)" class="btn btn-success btn-mini">Accepted</a>
                    @elseif($booking_request->status==3)
                    <a href="javascript:void(0)" class="btn btn-danger btn-mini">Declined</a>
                    @endif
                </td>
            </tr>
            @empty
            @php $i++ @endphp
            @endforelse
        </tbody>

    </table>

</div>
</div>

</div>
</div>

@stop
