<!-- Trip Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('trip_category_id', __('models/itineraries.fields.trip_category_id').':') !!}
    {!! Form::select('trip_category_id', $tripCategories, null, ['class' => 'form-control']) !!}
</div>

<!-- Day Field -->
<div class="form-group col-sm-6">
    {!! Form::label('day', __('models/itineraries.fields.day').':') !!}
    {!! Form::select('day', ['' => 'select', '1' => 'Day 1', '2' => 'Day 2', '3' => 'Day 3', '4' => 'Day 4', '5' => 'Day 5', '6' => 'Day 6', '7' => 'Day 7', '8' => 'Day 8', '9' => 'Day 9'], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.itineraries.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
