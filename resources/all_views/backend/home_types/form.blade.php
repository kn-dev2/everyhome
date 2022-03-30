<div class="row">
<div class="col-md-6">
<div class="form-group row @error('title') is-invalid @enderror">
    <label class="col-sm-4 col-form-label">Name</label>
    <div class="col-sm-6">
    {{ Form::hidden('id',null, ['class' => 'form-control']) }}
        {{ Form::text('title',old('title'), ['class' => 'form-control', 'placeholder' =>'Title', 'required' => 'required']) }}
        @error('title')
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
</div>
</div>

<style>
.invalid-feedback {
     display: block; 
}
</style>