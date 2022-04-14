@extends('layouts.frontend')

@section('content')

<div class="container">
    <div class="columns">
        <h3 class="heading">Profile <span></span></h3>
        <!-- <img class="loading" src="{{ asset('frontend/img/loading-buffering.gif') }}" alt=""> -->
        <div class="card">
            <div class="card-body">

            </div>
        </div>
    </div>
    {{ Form::model($profile,['route' => ['customer.profile.update'], 'method' => 'post','id' => 'edit-profile','enctype'=>"multipart/form-data"]) }}
    <div class="row profile-form">
        <div class="col-md-8">
        @include("backend.alerts.success")

            <div class="form-group row @error('name') is-invalid @enderror">
                <label class="col-sm-4 col-form-label">Name</label>
                <div class="col-sm-6">
                    {{ Form::text('name',old('name'),null,['class' => 'form-control','placeholder'=>'Enter your name']) }}
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row @error('email') is-invalid @enderror">
                <label class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-6">
                    {{ Form::text('email',old('email'),null,['class' => 'form-control','placeholder'=>'Enter your email','readonly'=>'readonly']) }}
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row @error('phone') is-invalid @enderror">
                <label class="col-sm-4 col-form-label">Phone</label>
                <div class="col-sm-6">
                    {{ Form::text('phone',old('phone'),null,['class' => 'form-control','placeholder'=>'Enter your phone']) }}
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row @error('suite') is-invalid @enderror">
                <label class="col-sm-4 col-form-label">Suite</label>
                <div class="col-sm-3">
                    {{ Form::text('suite',old('suite'),null,['class' => 'form-control','placeholder'=>'Enter your suite']) }}
                    @error('suite')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row @error('city') is-invalid @enderror">

                <label class="col-sm-4 col-form-label">City</label>

                <div class="col-sm-3">
                    {{ Form::text('city',old('city'),null,['class' => 'form-control','placeholder'=>'Enter your city']) }}
                    @error('city')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row @error('state') is-invalid @enderror">

                <label class="col-sm-4 col-form-label">State</label>

                <div class="col-sm-3">
                    {{ Form::select('state',$states,old('state'),['class' => 'form-control','placeholder'=>'Enter your state']) }}
                    @error('state')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row @error('zipcode') is-invalid @enderror">

                <label class="col-sm-4 col-form-label">Zipcode</label>

                <div class="col-sm-3">
                    {{ Form::number('zipcode',old('zipcode'),null,['class' => 'form-control','placeholder'=>'Enter your zipcode']) }}
                    @error('zipcode')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row @error('address') is-invalid @enderror">
                <label class="col-sm-4 col-form-label">Address</label>
                <div class="col-sm-6">
                    {{ Form::textarea('address',old('address'),null,['class' => 'form-control','placeholder'=>'Enter your address']) }}
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-8">
                    {{ Form::submit('Update Profile', ['class' => 'btn btn-lg btn-primary']) }}
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