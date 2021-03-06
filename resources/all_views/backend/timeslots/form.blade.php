<div class="row">
<div class="col-md-6">
<div class="form-group row @error('slot') is-invalid @enderror">
    <label class="col-sm-4 col-form-label">Time Slot</label>
    <div class="col-sm-6">
    {{ Form::hidden('id',null, ['class' => 'form-control']) }}

        {{ Form::text('slot',old('slot'), ['class' => 'form-control', 'placeholder' =>'Time Slot', 'required' => 'required']) }}
        @error('slot')
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
</div>

<style>
.invalid-feedback {
     display: block; 
}
</style>