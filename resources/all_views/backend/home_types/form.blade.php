<div class="row">
<div class="col-md-6">
<div class="form-group row @error('service_id') is-invalid @enderror">
    <label class="col-sm-4 col-form-label">Service</label>
    <div class="col-sm-6">
    {{ Form::hidden('id',null, ['class' => 'form-control']) }}

        {{ Form::select('service_id',$services,null, ['class' => 'form-control', 'placeholder' =>'Select Service', 'required' => 'required']) }}
        @error('service_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>


<div class="form-group row @error('price') is-invalid @enderror">
    <label class="col-sm-4 col-form-label">Price</label>
    <div class="col-sm-6">
        {{ Form::number('price',old('price'), ['class' => 'form-control', 'placeholder' =>'Price', 'required' => 'required']) }}
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>


<div class="form-group row @error('status') is-invalid @enderror">
    <label class="col-sm-4 col-form-label">Status</label>
    <div class="col-sm-6">
        {{ Form::select('status',$status_dropdown,null,['class' => 'form-control', 'placeholder' =>'Select Status']) }}
        @error('status')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>


</div>
<div class="col-md-6">
<div class="form-group row @error('title') is-invalid @enderror">
    <label class="col-sm-4 col-form-label">Title</label>
    <div class="col-sm-6">
        {{ Form::text('title',old('title'), ['class' => 'form-control', 'placeholder' =>'Title', 'required' => 'required']) }}
        @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-4 col-form-label">Total Time</label>
    <div class="col-sm-3 @error('hour') is-invalid @enderror" style="display:none">
        {{ Form::hidden('hour',old('hour'), ['min'=>0,'class' => 'form-control', 'placeholder' =>'Hour', 'required' => 'required']) }}
        @error('hour')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-sm-6 @error('min') is-invalid @enderror">
        {{ Form::number('min',old('min'), ['min'=>0,'class' => 'form-control', 'placeholder' =>'Min', 'required' => 'required']) }}
        @error('min')
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