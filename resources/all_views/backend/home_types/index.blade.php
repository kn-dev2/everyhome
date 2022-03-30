@extends('adminlte::page')

@section('content_header')
    <h1>Home Types</h1>
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">List of Home Types</h3>
    </div>
    <div class="card-body">
    @include("backend.alerts.success")
    @include("backend.alerts.error")

<a href="{{route('hometypes.create')}}" class="btn btn-primary btn-sm">+ Add Home Type</a>
<br><br>
<div class="table-responsive dt-responsive">
    <table id="dom-jqry" class="table table-striped table-bordered nowrap">
        <thead>
            <tr>
                <th>Title</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($home_types as $homeType)
            <tr>
                <td>{{ $homeType->title }}</td>
                <td>${{ $homeType->price }}</td>
                <td>{{ $homeType->status==0 ? 'In-Active' : 'Active' }}</td>
                <td>
                    <a href="{{route('hometypes.edit',$homeType->id)}}" class="btn btn-warning btn-mini">Edit</a>
                </td>
            </tr>
            @empty

            @endforelse

        </tbody>

    </table>

    <span>{{$home_types->links()}}</span>

</div>
</div>

</div>
</div>

@stop