<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/reserved_additional_trips.fields.id').':') !!}
    <p>{{ $reservedAdditionalTrip->id }}</p>
</div>

<!-- Reservation Id Field -->
<div class="form-group">
    {!! Form::label('reservation_id', __('models/reserved_additional_trips.fields.reservation_id').':') !!}
    <p>{{ $reservedAdditionalTrip->reservation_id }}</p>
</div>

<!-- Additional Trip Id Field -->
<div class="form-group">
    {!! Form::label('additional_trip_id', __('models/reserved_additional_trips.fields.additional_trip_id').':') !!}
    <p>{{ $reservedAdditionalTrip->additional_trip_id }}</p>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', __('models/reserved_additional_trips.fields.price').':') !!}
    <p>{{ $reservedAdditionalTrip->price }}</p>
</div>

<!-- Adults Count Field -->
<div class="form-group">
    {!! Form::label('adults_count', __('models/reserved_additional_trips.fields.adults_count').':') !!}
    <p>{{ $reservedAdditionalTrip->adults_count }}</p>
</div>

<!-- Child1 Count Field -->
<div class="form-group">
    {!! Form::label('child1_count', __('models/reserved_additional_trips.fields.child1_count').':') !!}
    <p>{{ $reservedAdditionalTrip->child1_count }}</p>
</div>

<!-- Child2 Count Field -->
<div class="form-group">
    {!! Form::label('child2_count', __('models/reserved_additional_trips.fields.child2_count').':') !!}
    <p>{{ $reservedAdditionalTrip->child2_count }}</p>
</div>

<!-- Total Price Field -->
<div class="form-group">
    {!! Form::label('total_price', __('models/reserved_additional_trips.fields.total_price').':') !!}
    <p>{{ $reservedAdditionalTrip->total_price }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/reserved_additional_trips.fields.created_at').':') !!}
    <p>{{ $reservedAdditionalTrip->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/reserved_additional_trips.fields.updated_at').':') !!}
    <p>{{ $reservedAdditionalTrip->updated_at }}</p>
</div>

