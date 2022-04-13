@extends('layouts.frontend')

<style>
    body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
    }

    h1 {
        color: #88B04B;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-weight: 900;
        font-size: 40px;
        margin-bottom: 10px;
    }

    p {
        color: #404F5E;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-size: 20px;
        margin: 0;
    }

    i {
        color: red;
        font-size: 153px;
        line-height: 200px;
        margin-left: 0px;
        top: 84px;
        position: relative;
    }

    .card {
        background: #ceeff6;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
        margin-bottom: 100px;
    }
</style>
@section('content')
<div class="card">
    <div style="border-radius: 200px;height: 200px;width: 200px;background: #E8FCFB;margin: 0 auto;">
        <i class="checkmark">x</i>
    </div>
    <h1 style="color:red">Payment Failed !</h1>
    <p>Transaction ID : {{$booking->booking_id}}<br/> Please try again later.</p>
    <a href="{{route('book.now')}}"><< Go to Booking Page</a>

</div>
@endsection