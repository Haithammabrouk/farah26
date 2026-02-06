<!-- Reservation Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reservation_id', __('models/reserved_additional_trips.fields.reservation_id').':') !!}
    {!! Form::text('reservation_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Additional Trip Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('additional_trip_id', __('models/reserved_additional_trips.fields.additional_trip_id').':') !!}
    {!! Form::text('additional_trip_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', __('models/reserved_additional_trips.fields.price').':') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Adults Count Field -->
<div class="form-group col-sm-6">
    {!! Form::label('adults_count', __('models/reserved_additional_trips.fields.adults_count').':') !!}
    {!! Form::text('adults_count', null, ['class' => 'form-control']) !!}
</div>

<!-- Child1 Count Field -->
<div class="form-group col-sm-6">
    {!! Form::label('child1_count', __('models/reserved_additional_trips.fields.child1_count').':') !!}
    {!! Form::text('child1_count', null, ['class' => 'form-control']) !!}
</div>

<!-- Child2 Count Field -->
<div class="form-group col-sm-6">
    {!! Form::label('child2_count', __('models/reserved_additional_trips.fields.child2_count').':') !!}
    {!! Form::text('child2_count', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_price', __('models/reserved_additional_trips.fields.total_price').':') !!}
    {!! Form::text('total_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.reservedAdditionalTrips.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
