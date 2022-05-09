@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row justify-content-center book_now">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                   <strong>Are you returning customer ?</strong>
                   <a href="{{route('login')}}" class="btn btn-success">Click Here</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                   <strong>Are you new customer ?</strong>
                   <a href="{{route('register')}}" class="btn btn-success">Click Here</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection