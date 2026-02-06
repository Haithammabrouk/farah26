<!-- Date Field -->
<div class="form-group col-sm-3">
    {!! Form::label('date', __('models/closedDates.fields.date').':') !!}
    {!! Form::text('date', null, ['class' => 'form-control datetimepicker']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.closedDates.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
