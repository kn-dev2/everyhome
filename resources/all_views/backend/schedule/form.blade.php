<div class="row">
<div class="col-md-6">
<div class="form-group row @error('date') is-invalid @enderror">
    <label class="col-sm-4 col-form-label">Date</label>
    <div class="col-sm-6">
    {{ Form::hidden('id',null, ['class' => 'form-control']) }}

        {{ Form::date('date',old('date'), ['class' => 'form-control', 'placeholder' =>'Date', 'required' => 'required']) }}
        @error('date')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@if(!isset($maid_time_slot->time_slot_id))
<div class="form-group row @error('time_slot_id') is-invalid @enderror">
    <label class="col-sm-4 col-form-label">Time Slot</label>
    <div class="col-sm-6">
        {{ Form::select('time_slot_id[]',$slots,null, ['class' => 'form-control', 'required' => 'required','multiple'=>true]) }}
        @error('time_slot_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@else

<div class="form-group row @error('time_slot_id') is-invalid @enderror">
    <label class="col-sm-4 col-form-label">Time Slot</label>
    <div class="col-sm-6">
        {{ Form::select('time_slot_id',$slots,null, ['class' => 'form-control', 'required' => 'required']) }}
        @error('time_slot_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

@endif



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