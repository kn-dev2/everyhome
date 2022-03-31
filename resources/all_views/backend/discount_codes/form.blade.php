<div class="row">
<div class="col-md-6">
<div class="form-group row @error('discount_code') is-invalid @enderror">
    <label class="col-sm-4 col-form-label">Discount Code</label>
    <div class="col-sm-6">
    {{ Form::hidden('id',null, ['class' => 'form-control']) }}
        {{ Form::text('discount_code',old('discount_code'), ['class' => 'form-control', 'placeholder' =>'Discount Code', 'required' => 'required']) }}
        @error('discount_code')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row @error('type') is-invalid @enderror">
    <label class="col-sm-4 col-form-label">Discount Type</label>
    <div class="col-sm-6">
        {{ Form::select('type',$discountType,null,['class' => 'form-control', 'placeholder' =>'Select Type']) }}
        @error('type')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row @error('amount') is-invalid @enderror">
    <label class="col-sm-4 col-form-label">Amount</label>
    <div class="col-sm-6">
        {{ Form::text('amount',old('amount'), ['class' => 'form-control', 'placeholder' =>'Amount', 'required' => 'required']) }}
        @error('amount')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row @error('no_of_usage_customer') is-invalid @enderror">
    <label class="col-sm-4 col-form-label">No. of usage per customer</label>
    <div class="col-sm-6">
        {{ Form::number('no_of_usage_customer',old('no_of_usage_customer'), ['class' => 'form-control', 'placeholder' =>'No. of usage per customer', 'required' => 'required','min' => 1, 'max' => '1000000000']) }}
        @error('no_of_usage_customer')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row @error('min_spend') is-invalid @enderror">
    <label class="col-sm-4 col-form-label">Minimum Spend</label>
    <div class="col-sm-6">
        {{ Form::number('min_spend',old('min_spend'), ['class' => 'form-control', 'placeholder' =>'Minimum Spend', 'required' => 'required', 'min' => 1, 'max' => '1000000000']) }}
        @error('min_spend')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

</div>
<div class="col-md-6">

<div class="form-group row @error('vaild_from') is-invalid @enderror">
    <label class="col-sm-4 col-form-label">From</label>
    <div class="col-sm-6">
        {{ Form::text('vaild_from',old('vaild_from'), ['class' => 'form-control', 'placeholder' =>'From', 'required' => 'required', 'id' => 'dt1']) }}
        @error('vaild_from')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row @error('valid_till') is-invalid @enderror">
    <label class="col-sm-4 col-form-label">To</label>
    <div class="col-sm-6">
       {{ Form::text('valid_till',old('valid_till'), ['class' => 'form-control', 'placeholder' =>'To', 'required' => 'required', 'id' => 'dt2']) }}
        @error('valid_till')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
</div>
</div>

<style>
.invalid-feedback {
     display: block; 
}
</style>