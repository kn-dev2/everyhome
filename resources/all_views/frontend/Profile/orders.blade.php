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
                    <th>Schedule Type</th>
                    <th>Total Price</th>
                    <th>Status</th>
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
                    <td>{{$SingleBooking->schedule_type }}</td>
                    <td>${{$SingleBooking->total_price }}</td>
                    <td>
                        <span class="badge {{$Status}}">{{$SingleBooking->status }}</span>
                    </td>
                    <td><a href="{{route('customer.order.details',$SingleBooking->id)}}"><button type="button" class="btn btn-secondary">Show Details</button></a>
                    </td>
                </tr>
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
</style>