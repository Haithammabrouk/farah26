<!-- Trip Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('trip_id', __('models/reservations.fields.trip_id').':') !!}
    {!! Form::text('trip_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('models/reservations.fields.user_id').':') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Comment Field -->
<div class="form-group col-sm-6">
    {!! Form::label('comment', __('models/reservations.fields.comment').':') !!}
    {!! Form::text('comment', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', __('models/reservations.fields.status').':') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.reservations.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
