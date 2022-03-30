@extends('adminlte::page')

@section('content_header')
    <h1>Services</h1>
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">List of Services</h3>
    </div>
    <div class="card-body">
    @include("backend.alerts.success")
    @include("backend.alerts.error")

<a href="{{route('services.create')}}" class="btn btn-primary btn-sm">+ Add Service</a>
<br><br>
<div class="table-responsive dt-responsive">
    <table id="dom-jqry" class="table table-striped table-bordered nowrap">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $service)
            <tr>
                <td>{{ $service->title }}</td>
                <td>{{ $service->status==0 ? 'In-Active' : 'Active' }}</td>
                <td>
                    <a href="{{route('services.edit',$service->id)}}" class="btn btn-warning btn-mini">Edit</a>
                </td>
            </tr>
            @empty

            @endforelse

        </tbody>

    </table>

    <span>{{$services->links()}}</span>

</div>
</div>

</div>
</div>

@stop