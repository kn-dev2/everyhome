@extends('adminlte::page')

@section('content_header')
    <h1>Home Sub Types</h1>
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">List of Home Sub Types</h3>
    </div>
    <div class="card-body">
    @include("backend.alerts.success")
    @include("backend.alerts.error")

<a href="{{route('homesubtypes.create')}}" class="btn btn-primary btn-sm">+ Add Home Sub Type</a>
<br><br>
<div class="table-responsive dt-responsive">
    <table id="dom-jqry" class="table table-striped table-bordered nowrap">
        <thead>
            <tr>
                <th>Home Type</th>
                <th>Title</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($home_sub_types as $homesubType)
            <tr>
                <td>{{ $homesubType->hometype->title }}</td>
                <td>{{ $homesubType->title }}</td>
                <td>${{ $homesubType->price }}</td>
                <td>{{ $homesubType->status==0 ? 'In-Active' : 'Active' }}</td>
                <td>
                    <a href="{{route('homesubtypes.edit',$homesubType->id)}}" class="btn btn-warning btn-mini">Edit</a>
                </td>
            </tr>
            @empty

            @endforelse

        </tbody>

    </table>

    <span>{{$home_sub_types->links()}}</span>

</div>
</div>

</div>
</div>

@stop