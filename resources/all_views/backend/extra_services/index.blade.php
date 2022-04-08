@extends('adminlte::page')

@section('content_header')
    <h1>Extra Services</h1>
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">List of Extra Services</h3>
    </div>
    <div class="card-body">
    @include("backend.alerts.success")
    @include("backend.alerts.error")

<a href="{{route('extra_services.create')}}" class="btn btn-primary btn-sm">+ Add Extra Service</a>
<br><br>
<div class="table-responsive dt-responsive">
    <table id="dom-jqry" class="table table-striped table-bordered nowrap">
        <thead>
            <tr>
                <th>Service</th>
                <th>Icon</th>
                <th>Type</th>
                <th>Title</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($extra_services as $extra_service)
            <tr>
                <td>{{ $extra_service->service->title }}</td>
                <td><img src="{{ asset(config('global.extra_service_img_path')).'/'.$extra_service->icon }}" width="50px"/></td>
                <td>{{ $extra_service->type==1 ? 'Quantity wise' : 'Only single item' }}</td>
                <td>{{ $extra_service->title }}</td>
                <td>${{ $extra_service->price }}</td>
                <td>{{ $extra_service->status==0 ? 'In-Active' : 'Active' }}</td>
                <td>
                    <a href="{{route('extra_services.edit',$extra_service->id)}}" class="btn btn-warning btn-mini">Edit</a>
                </td>
            </tr>
            @empty

            @endforelse

        </tbody>

    </table>

    <span>{{$extra_services->links()}}</span>

</div>
</div>

</div>
</div>

@stop