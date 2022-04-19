@extends('layouts.frontend')

@section('content')

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
            <table style="width: 100%;">
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
                    <th>Accept Status by Maid</th>
                    <th>Action</th>
                </tr>
                @php $i=1; $Status;@endphp
                @foreach($orders as $SingleBooking)

                @if($SingleBooking->status == 'failed')
                @php $Status = 'bg-danger'; @endphp
                @else
                @php $Status = 'bg-success'; @endphp
                @endif
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
                {!! isset($SingleBooking->acceptRequests->maid_time_slot->maidDetails->name) ? '<a class="button" href="#popup'.$SingleBooking->id.'">Show Maid Details</a>' : 'Not accepted yet' !!}
                    </td>
                    <td><a href="{{route('customer.order.details',$SingleBooking->id)}}" class="button">Order Details</a>
                    </td>
                </tr>

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
                        </div>
                    </div>
                </div>

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
</style>