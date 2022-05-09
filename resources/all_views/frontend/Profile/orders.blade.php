@extends('layouts.frontend')

@section('content')
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

<div class="container">
    <div class="columns">
        <h3 class="heading">Orders <span></span></h3>
        <div class="card">
            <div class="card-body">

            </div>
        </div>
    </div>
    <div class="row profile-form">
        <div class="col-md-8">
            <table style="width: 100%;" class="datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Transaction ID</th>
                    <th>Service</th>
                    <th>Home Type</th>
                    <th>Home Sub Type</th>
                    <th>Time Slot</th>
                    <th>Schedule Type</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Coupan Recieved<br/><small>(Will be use on next booking for <br/>10% discount & validity up to 30 days )</small></th>
                    <th>Accept Status by Maid</th>
                    <th>Action</th>
                </tr>
            </thead>
                @php $i=1; $Status;@endphp
                @foreach($orders as $SingleBooking)

                @if($SingleBooking->status == 'failed')
                @php $Status = 'bg-danger'; @endphp
                @else
                @php $Status = 'bg-success'; @endphp
                @endif
                <tbody>
                <tr>
                    <td>{{$i}}</td>
                    <td>{{ date('d M Y',strtotime($SingleBooking->booking_date)) }}</td>
                    <td>{{$SingleBooking->booking_id }}</td>
                    <td>{{$SingleBooking->service->title }}</td>
                    <td>{{$SingleBooking->home_type->title}}</td>
                    <td>{{isset($SingleBooking->home_sub_type->title) ? $SingleBooking->home_sub_type->title : '--'  }}</td>
                    <td>{{$SingleBooking->time_slot->slot }}</td>
                    <td>{{$SingleBooking->schedule_type }}</td>
                    <td>${{$SingleBooking->total_price }}</td>
                    <td>
                        <span class="badge {{$Status}}">{{$SingleBooking->status }}</span>
                    </td>
                    <td>
                       {{$SingleBooking->late_coupan_recieved=='' ? 'No coupan recieved' : $SingleBooking->late_coupan_recieved }}
                    </td>
                    <td>
                        {!! isset($SingleBooking->acceptRequests->maid_time_slot->maidDetails->name) ? '<a class="button" href="#popup'.$SingleBooking->id.'">Show Maid Details</a>' : 'Not accepted yet' !!}
                    </td>
                    <td>
                        @if($SingleBooking->NotacceptedByOther($SingleBooking->id)<= 600) 
                            <a href="#edit_popup{{$SingleBooking->id}}" class="button">Edit Details</a>
                            <a href="{{route('customer.order.details',$SingleBooking->id)}}" class="button">Order Details</a>

                            @else
                            <a href="{{route('customer.order.details',$SingleBooking->id)}}" class="button">Order Details</a>
                            @endif
                    </td>
                </tr>
                </tbody>

                <div id="edit_popup{{$SingleBooking->id}}" class="overlay">
                    <div class="popup">
                        <h2>Edit Booking Details</h2>
                        <a class="close" href="#">&times;</a>
                        <div class="content">
                            <div class="form-group">
                                <label class="col-sm-4 col-form-label">When would you like us to come?</label>
                                <br>
                                <div class="col-sm-3">
                                    {{ Form::text('date',null,['class' => 'form-control date', 'placeholder' =>'Click to choose a date','data-id'=>$SingleBooking->id,'id'=>'date'.$SingleBooking->id,'readyonly'=>'readonly']) }}
                                    <span class="invalid-feedback" role="alert" id="date_error{{$SingleBooking->id}}">
                                    </span>
                                </div>

                                <div class="col-sm-3 @error('time_slot') is-invalid @enderror">
                                    <!-- <SELECT ID="my_select" class="select_time_slot"></SELECT> -->
                                    {{ Form::select('time_slot_select',array(),null,['class' => 'form-control select_time_slot', 'placeholder' =>'--','data-id'=>$SingleBooking->id,'id'=>'time_slot'.$SingleBooking->id]) }}
                                    {{ Form::hidden('time_slot',null,['class' => 'form-control','id'=>'final_time_slot'.$SingleBooking->id]) }}
                                    <span class="invalid-feedback" role="alert" id="time_slot_error{{$SingleBooking->id}}">
                                    </span>
                                </div>
                            </div>
                            <button class="button updateTimeDetails" data-id="{{$SingleBooking->id}}">Update Details</button>
                        </div>
                    </div>
                </div>

                <div id="popup{{$SingleBooking->id}}" class="overlay">
                    <div class="popup">
                        <h2>Maid Details</h2>
                        <a class="close" href="#">&times;</a>
                        <div class="content">
                            <p>Name : {{isset($SingleBooking->acceptRequests->maid_time_slot->maidDetails->name) ? $SingleBooking->acceptRequests->maid_time_slot->maidDetails->name : '' }} </p>
                            <p>Email : {{isset($SingleBooking->acceptRequests->maid_time_slot->maidDetails->email) ? $SingleBooking->acceptRequests->maid_time_slot->maidDetails->email : ''}} </p>
                            <p>Phone No : {{isset($SingleBooking->acceptRequests->maid_time_slot->maidDetails->phone) ? $SingleBooking->acceptRequests->maid_time_slot->maidDetails->phone : '' }} </p>
                            <p> Arrive Date : {{ isset($SingleBooking->acceptRequests->arrive_date) ? date('d M Y',strtotime($SingleBooking->acceptRequests->arrive_date)) : ''}} </p>
                            <p>Arrive Time : {{isset($SingleBooking->acceptRequests->arrive_time) ? $SingleBooking->acceptRequests->arrive_time : ''}} </p>
                            <p>Special Instructions : {{isset($SingleBooking->acceptRequests->special_instructions) ? $SingleBooking->acceptRequests->special_instructions : ''}} </p>
                            @if(isset($SingleBooking->acceptRequests))
                            @if($SingleBooking->acceptRequests->status==2 || $SingleBooking->acceptRequests->status== 4)
                            <a class="button" href="#popup_review{{$SingleBooking->acceptRequests->id}}">Give Review</a>
                            @endif
                            @if($SingleBooking->acceptRequests->status==6 || $SingleBooking->acceptRequests->status== 7)
                            <div class='rating-stars text-center'>
                                <ul class='stars'>
                                    @if($SingleBooking->acceptRequests->rating==1)
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
                                    @elseif($SingleBooking->acceptRequests->rating==2)
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

                                    @elseif($SingleBooking->acceptRequests->rating==3)
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

                                    @elseif($SingleBooking->acceptRequests->rating==4)
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
                                    @elseif($SingleBooking->acceptRequests->rating==5)
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
                            <textarea class="form-control" disabled>{{$SingleBooking->acceptRequests->review_by_customer}}</textarea>

                            @endif
                            @endif
                        </div>
                    </div>
                </div>
                @if(isset($SingleBooking->acceptRequests))

                @if($SingleBooking->acceptRequests->status==2 || $SingleBooking->acceptRequests->status== 4)
                <div id="popup_review{{$SingleBooking->acceptRequests->id}}" class="overlay">
                    <div class="popup">
                        <a class="close" href="#">&times;</a>
                        <section class='rating-widget'>
                            <div class="profile" style="width: 50%">
                                <img class="circular--square" src="https://png.pngitem.com/pimgs/s/649-6490124_katie-notopoulos-katienotopoulos-i-write-about-tech-round.png" />
                            </div>
                            <div class="profile" style="width: 50%;top: -21px;position: relative;">
                                {{isset($SingleBooking->acceptRequests->maid_time_slot->maidDetails->name) ? $SingleBooking->acceptRequests->maid_time_slot->maidDetails->name : '' }}<br>
                                {{isset($SingleBooking->acceptRequests->maid_time_slot->maidDetails->email) ? $SingleBooking->acceptRequests->maid_time_slot->maidDetails->email : '' }}<br>
                                {{isset($SingleBooking->acceptRequests->maid_time_slot->maidDetails->phone) ? $SingleBooking->acceptRequests->maid_time_slot->maidDetails->phone : '' }}
                            </div>
                            <!-- Rating Stars Box -->
                            <div class='rating-stars text-center'>
                                <ul class='stars'>
                                    <li class='star' title='Poor' data-value='1' data-id="{{$SingleBooking->acceptRequests->id}}">
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='Fair' data-value='2' data-id="{{$SingleBooking->acceptRequests->id}}">
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='Good' data-value='3' data-id="{{$SingleBooking->acceptRequests->id}}">
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='Excellent' data-value='4' data-id="{{$SingleBooking->acceptRequests->id}}">
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='WOW!!!' data-value='5' data-id="{{$SingleBooking->acceptRequests->id}}">
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                </ul>
                            </div>
                        </section>
                        <input class="form-control" type="hidden" name="rating" id="rating{{$SingleBooking->acceptRequests->id}}">
                        <textarea class="form-control" placeholder="Enter Review" name="review" id="review{{$SingleBooking->acceptRequests->id}}"></textarea>
                        <a href="javascript:void(0)" class="button order_request_click" data-id="{{$SingleBooking->acceptRequests->id}}" data-status="completed">Completed</a>
                        <a href="javascript:void(0)" class="button order_request_click" data-id="{{$SingleBooking->acceptRequests->id}}" data-status="not_completed">Not Completed</a>
                    </div>
                </div>
                @endif
                @endif
                @php $i++; @endphp
                @endforeach
            </table>
            <span>{{$orders->links()}}</span>
        </div>
    </div>
</div>



@endsection
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

    .box {
        width: 40%;
        margin: 0 auto;
        background: rgba(255, 255, 255, 0.2);
        padding: 35px;
        border: 2px solid #fff;
        border-radius: 20px/50px;
        background-clip: padding-box;
        text-align: center;
    }

    .button {
        font-size: 1em;
        padding: 10px;
        color: #fff;
        border: 2px solid #06D85F;
        border-radius: 20px/50px;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease-out;
    }

    .button:hover {
        background: #06D85F;
    }

    .overlay {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        transition: opacity 500ms;
        visibility: hidden;
        opacity: 0;
    }

    .overlay:target {
        visibility: visible;
        opacity: 1;
    }

    .popup {
        margin: 70px auto;
        padding: 20px;
        background: #fff;
        border-radius: 5px;
        width: 30%;
        position: relative;
        transition: all 5s ease-in-out;
    }

    .popup h2 {
        margin-top: 0;
        color: #333;
        font-family: Tahoma, Arial, sans-serif;
    }

    .popup .close {
        position: absolute;
        top: 20px;
        right: 30px;
        transition: all 200ms;
        font-size: 30px;
        font-weight: bold;
        text-decoration: none;
        color: #333;
    }

    .popup .close:hover {
        color: #06D85F;
    }

    .popup .content {
        max-height: 30%;
        overflow: auto;
    }

    @media screen and (max-width: 700px) {
        .box {
            width: 70%;
        }

        .popup {
            width: 70%;
        }
    }

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

    .circular--square {
        border-radius: 50%;
    }

    .circular--square {
        border-top-left-radius: 50% 50%;
        border-top-right-radius: 50% 50%;
        border-bottom-right-radius: 50% 50%;
        border-bottom-left-radius: 50% 50%;
    }

    .circular--square {
        width: 100px;
    }

    .rating-widget .profile {
        display: table-cell;
    }
</style>