@extends('adminlte::page')

@section('content_header')
<h1>Extra Service</h1>
@stop

@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add New Extra Service</h3>
    </div>
    <div class="card-body">
{{ Form::open(['route' => 'extra_services.store', 'method' => 'post','id' => 'create-extra_service','class'=>"form-horizontal",'enctype'=>"multipart/form-data"]) }}

@include("backend.extra_services.form")

<div class="form-group row">
    <label class="col-sm-2 col-form-label"></label>
    <div class="col-sm-8">
        {{ Form::submit('Save', ['class' => 'btn btn-lg btn-primary']) }}

    </div>
</div>
{{ Form::close() }}
</div>
</div>

@stop