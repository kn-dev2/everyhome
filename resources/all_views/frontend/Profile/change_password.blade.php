@extends('layouts.frontend')

@section('content')

<div class="container">
    <div class="columns">
        <h3 class="heading">Change <span>Password</span></h3>
        <!-- <img class="loading" src="{{ asset('frontend/img/loading-buffering.gif') }}" alt=""> -->
        <div class="card">
            <div class="card-body">

            </div>
        </div>
    </div>
    {{ Form::model($profile,['route' => ['customer.password.update'], 'method' => 'post','id' => 'edit-profile','enctype'=>"multipart/form-data"]) }}
    <div class="row profile-form">
        <div class="col-md-8">
        @include("backend.alerts.success")

            <div class="form-group row @error('password') is-invalid @enderror">
                <label class="col-sm-4 col-form-label">Password</label>
                <div class="col-sm-6">
                {{ Form::hidden('name',null) }}
                    {{ Form::password('password',null,['class' => 'form-control','placeholder'=>'Enter password']) }}
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row @error('confirm_password') is-invalid @enderror">
                <label class="col-sm-4 col-form-label">Confirm Password</label>
                <div class="col-sm-6">
                    {{ Form::password('confirm_password',null,['class' => 'form-control','placeholder'=>'Enter confirm password']) }}
                    @error('confirm_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
           

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-8">
                    {{ Form::submit('Update Password', ['class' => 'btn btn-lg btn-primary']) }}
                </div>
            </div>
        </div>

        {{ Form::close() }}


        @endsection

        <style>
            .profile-form .col-md-8 {
                width: 55%;
                float: left;
                background: #c2e3e9 !important;
                margin-right: 20px;
                padding: 40px 50px;
                margin-left: 23%;
            }
        </style>