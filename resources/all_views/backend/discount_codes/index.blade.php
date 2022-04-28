@extends('adminlte::page')

@section('content_header')
    <h1>Discount Codes</h1>
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">List of Discount Codes</h3>
    </div>
    <div class="card-body">
    @include("backend.alerts.success")
    @include("backend.alerts.error")

<a href="{{route('discount_codes.create')}}" class="btn btn-primary btn-sm">+ Add Discount Code</a>
<br><br>
<div class="table-responsive dt-responsive">
    <table id="dom-jqry" class="table table-striped table-bordered nowrap">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Discount Code</th>
                <th>Amount</th>
                <th>Vaild From</th>
                <th>Vaild Till</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($discount_codes as $discount_code)
            <tr>
                <td>{{ isset($discount_code->customer->name) ? $discount_code->customer->name : '--'  }}</td>
                <td>{{ $discount_code->discount_code }}</td>
                <td>{{ $discount_code->amount }}</td>
                <td>{{ $discount_code->vaild_from }}</td>
                <td>{{ $discount_code->valid_till }}</td>
                <td>
                    <a href="{{route('discount_codes.edit',$discount_code->id)}}" class="btn btn-warning btn-mini">Edit</a>
                </td>
            </tr>
            @empty

            @endforelse

        </tbody>

    </table>

    <span>{{$discount_codes->links()}}</span>

</div>
</div>

</div>
</div>

@stop