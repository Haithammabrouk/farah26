<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/additionalTripsPhotos.fields.trip_name').':') !!}
    <p>{{ $additionalTripsPhotos->additionalTrip->name }}</p>
</div>

<!-- Photo Field -->
<div class="form-group">
    {!! Form::label('photo', __('models/additionalTripsPhotos.fields.photo').':') !!}
    <br />
    <img src="{{ asset($additionalTripsPhotos->photo) }}" width="200">
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/additionalTripsPhotos.fields.created_at').':') !!}
    <p>{{ $additionalTripsPhotos->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/additionalTripsPhotos.fields.updated_at').':') !!}
    <p>{{ $additionalTripsPhotos->updated_at }}</p>
</div>