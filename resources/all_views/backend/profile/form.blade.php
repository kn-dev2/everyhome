<div class="row">
<div class="col-md-6">
<div class="form-group row @error('name') is-invalid @enderror">
    <label class="col-sm-4 col-form-label">Name</label>
    <div class="col-sm-6">
        {{ Form::text('name',old('name'), ['class' => 'form-control', 'placeholder' =>'Name', 'required' => 'required']) }}
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row @error('password') is-invalid @enderror">
    <label class="col-sm-4 col-form-label">Password</label>
    <div class="col-sm-6">
        {{ Form::password('password',['class' => 'form-control', 'placeholder' =>'Enter Password']) }}
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>


</div>
<div class="col-md-6">

<div class="form-group row @error('email') is-invalid @enderror">
    <label class="col-sm-4 col-form-label">Email</label>
    <div class="col-sm-6">
        {{ Form::text('email',old('email'), ['class' => 'form-control', 'placeholder' =>'Email', 'required' => 'required','disabled'=>'disabled']) }}
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row @error('confirm_password') is-invalid @enderror">
    <label class="col-sm-4 col-form-label">Confirm Password</label>
    <div class="col-sm-6">
        {{ Form::password('confirm_password',['class' => 'form-control', 'placeholder' =>'Enter Confirm Password']) }}
        @error('confirm_password')
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