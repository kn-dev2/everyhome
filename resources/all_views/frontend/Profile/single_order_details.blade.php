@extends('layouts.frontend')

@section('content')

<div class="container">
    <div class="columns">
        <h3 class="heading">Order <span>Details</span></h3>
        <a href="{{route('customer.orders')}}" style="float: right;right: 44px;position: relative;"><< Go to orders</a>
        <div class="card">
            <div class="card-body">

            </div>
        </div>
    </div>
    <div class="row profile-form">
        <div class="col-md-8">
            <div class="booking_data">
            <p>Date - {{ date('d M Y',strtotime($order_details->booking_date)) }}</p>
            <p>Transaction ID - {{$order_details->booking_id }}</p>
            <p>Service - {{$order_details->service->title }}</p>
            <p>Home Type - {{$order_details->home_type->title}}</p>
            <p>Home Sub Type - {{isset($order_details->home_sub_type->title) ? $order_details->home_sub_type->title : '--'  }}</p>
            <p>Schedule Type - {{$order_details->schedule_type }}</p>
            <p>Total Hours - {{$hours.' hours'.' '.$min.' minutes' }}</p>
            @if(isset($order_details->home_sub_type->price))
            <h4 style="text-align: right;">Sub Total : ${{$order_details->home_type->price + $order_details->home_sub_type->price }}</h4>
            @else
            <h4 style="text-align: right;">Sub Total : ${{$order_details->home_type->price }}</h4>
            @endif
            </div>
        </div>
        <div class="col-md-8">
            <table style="width: 100%;">
                <tr>
                    <th>Extra Service</th>
                    <th>Quantity</th>
                    <th>Base Price</th>
                    <th>Price</th>
                </tr>
                @php $i=1; $Status;@endphp
                @foreach($order_details->items as $Item)

                <tr>
                    <td>{{$Item->extra_service->title }}</td>
                    <td>{{$Item->qty}}</td>
                    <td>${{$Item->base_price }}</td>
                    <td>${{$Item->price }}</td>
                </tr>
                @php $i++; @endphp
                @endforeach
            </table>

            <h2 style="text-align: right;">Total Price : ${{$order_details->total_price }}</h2>
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
    .booking_data {
    text-align: center;
    background: #f2f2f2;
}
</style>