@extends('adminlte::page')

@section('content_header')
    <h1>Schedules</h1>
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">List of Schedules</h3>
    </div>
    <div class="card-body">
    @include("backend.alerts.success")
    @include("backend.alerts.error")

<a href="{{route('schedules.create')}}" class="btn btn-primary btn-sm">+ Add Schedule</a>
<br><br>
<div class="table-responsive dt-responsive">
    <table id="dom-jqry" class="table table-striped table-bordered nowrap">
        <thead>
            <tr>
                <th>Date</th>
                <th>Schedule</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($maid_time_slots as $SingleTimeSlot)
            <tr>
                <td>{{ date('d M, Y',strtotime($SingleTimeSlot->date)) }}</td>
                <td>{{ $SingleTimeSlot->timeSlot->slot }}</td>
                <td>{{ $SingleTimeSlot->status==0 ? 'In-Active' : 'Active' }}</td>
                <td>
                    <a href="{{route('schedules.edit',$SingleTimeSlot->id)}}" class="btn btn-warning btn-mini">Edit</a>
                </td>
            </tr>
            @empty

            @endforelse

        </tbody>

    </table>

</div>
</div>

</div>
</div>

@stop