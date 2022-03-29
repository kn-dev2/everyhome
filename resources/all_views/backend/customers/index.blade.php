@extends('adminlte::page')

@section('content_header')
    <h1>Customers</h1>
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">List of Customers</h3>
    </div>
    <div class="card-body">
    @include("backend.alerts.success")
    @include("backend.alerts.error")

<a href="{{route('customers.create')}}" class="btn btn-primary btn-sm">+ Add Customer</a>
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
            @forelse($customers as $customer)
            <tr>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->status==0 ? 'In-Active' : 'Active' }}</td>
                <td>
                    <a href="{{route('customers.edit',$customer->id)}}" class="btn btn-warning btn-mini">Edit</a>
                </td>
            </tr>
            @empty

            @endforelse

        </tbody>

    </table>

    <span>{{$customers->links()}}</span>

</div>
</div>

</div>
</div>

@stop