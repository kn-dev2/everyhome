@extends('adminlte::page')

@section('content_header')
<h1>Extra Service</h1>
@stop
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Update Extra Service</h3>
    </div>
    <div class="card-body">

    @include("backend.alerts.success")

    {{ Form::model($extra_service,['route' => ['extra_services.update', $extra_service->id], 'method' => 'put','id' => 'edit-Extra-Service','enctype'=>"multipart/form-data"]) }}

    @include("backend.extra_services.form")
    <div class="form-group row">
        <label class="col-sm-2 col-form-label"></label>
        <div class="col-sm-8">
            {{ Form::submit('Update', ['class' => 'btn btn-lg btn-primary']) }}
        </div>
    </div>
    {{ Form::close() }}
    </div>
    </div>
@stop