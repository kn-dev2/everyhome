@extends('adminlte::page')

@section('content_header')
    <h1>Maids</h1>
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">List of Maids</h3>
    </div>
    <div class="card-body">
    @include("backend.alerts.success")
    @include("backend.alerts.error")

<a href="{{route('maids.create')}}" class="btn btn-primary btn-sm">+ Add Maid</a>
<br><br>
<div class="table-responsive dt-responsive">
    <table id="dom-jqry" class="table table-striped table-bordered nowrap">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($maids as $maid)
            <tr>
                <td>{{ $maid->name }}</td>
                <td>{{ $maid->email }}</td>
                <td>{{ $maid->status==0 ? 'In-Active' : 'Active' }}</td>
                <td>
                    <a href="{{route('maids.edit',$maid->id)}}" class="btn btn-warning btn-mini">Edit</a>
                </td>
            </tr>
            @empty

            @endforelse

        </tbody>

    </table>

    <span>{{$maids->links()}}</span>

</div>
</div>

</div>
</div>

@stop