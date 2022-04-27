@extends('adminlte::page')

@section('content_header')
<h1>Home Sub Type</h1>
@stop
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Update Home Sub Types</h3>
    </div>
    <div class="card-body">

    @include("backend.alerts.success")

    {{ Form::model($home_sub_type,['route' => ['homesubtypes.update', $home_sub_type->id], 'method' => 'put','id' => 'edit-hometypes','enctype'=>"multipart/form-data"]) }}

    @include("backend.home_sub_types.form")
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