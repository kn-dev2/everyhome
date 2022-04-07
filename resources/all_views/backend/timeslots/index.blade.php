@extends('adminlte::page')

@section('content_header')
    <h1>Time Slots</h1>
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">List of Time Slots</h3>
    </div>
    <div class="card-body">
    @include("backend.alerts.success")
    @include("backend.alerts.error")

<a href="{{route('timeslots.create')}}" class="btn btn-primary btn-sm">+ Add Time Slot</a>
<br><br>
<div class="table-responsive dt-responsive">
    <table id="dom-jqry" class="table table-striped table-bordered nowrap">
        <thead>
            <tr>
                <th>Time Slot</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($timeslots as $timeslot)
            <tr>
                <td>{{ $timeslot->slot }}</td>
                <td>{{ $timeslot->status==0 ? 'In-Active' : 'Active' }}</td>
                <td>
                    <a href="{{route('timeslots.edit',$timeslot->id)}}" class="btn btn-warning btn-mini">Edit</a>
                </td>
            </tr>
            @empty

            @endforelse

        </tbody>

    </table>

    <span>{{$timeslots->links()}}</span>

</div>
</div>

</div>
</div>

@stop