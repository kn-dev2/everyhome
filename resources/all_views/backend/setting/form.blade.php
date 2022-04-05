<div class="row">
<div class="col-md-6">
<div class="form-group row @error('commision') is-invalid @enderror">
    <label class="col-sm-4 col-form-label">Commision</label>
    <div class="col-sm-2">
        {{ Form::text('commision',old('commision'), ['class' => 'form-control', 'placeholder' =>'Commision', 'required' => 'required']) }}
        @error('commision')
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