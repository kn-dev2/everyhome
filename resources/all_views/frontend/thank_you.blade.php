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
        color: #9ABC66;
        font-size: 100px;
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
        <i class="checkmark">✓</i>
    </div>
    <h1>Payment Success !</h1>
    <p>Transaction ID : {{$booking->booking_id}}<br /> Amount : {{ env('STRIPE_CURRENCY_SIGN').$booking->total_price}}</p>
    <a href="{{route('home')}}"><< Go to Home</a>

</div>
@endsection