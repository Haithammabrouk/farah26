<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/itineraries.fields.id').':') !!}
    <p>{{ $itineraries->id }}</p>
</div>

<!-- Trip Category Id Field -->
<div class="form-group">
    {!! Form::label('trip_category_id', __('models/itineraries.fields.trip_category_id').':') !!}
    <p>{{ $itineraries->tripCategory->name }}</p>
</div>

<!-- Day Field -->
<div class="form-group">
    {!! Form::label('day', __('models/itineraries.fields.day').':') !!}
    <p>{{ $itineraries->day }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/itineraries.fields.created_at').':') !!}
    <p>{{ $itineraries->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/itineraries.fields.updated_at').':') !!}
    <p>{{ $itineraries->updated_at }}</p>
</div>

