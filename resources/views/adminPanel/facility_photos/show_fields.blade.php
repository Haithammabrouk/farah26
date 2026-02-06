<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/facilityPhotos.fields.facility_title').':') !!}
    <p>{{ $facilityPhoto->facility->name }}</p>
</div>

<!-- Photo Field -->
<div class="form-group">
    {!! Form::label('photo', __('models/facilityPhotos.fields.photo').':') !!}
    <br />
    <img src="{{ asset($facilityPhoto->photo) }}" width="200">
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/facilityPhotos.fields.created_at').':') !!}
    <p>{{ $facilityPhoto->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/facilityPhotos.fields.updated_at').':') !!}
    <p>{{ $facilityPhoto->updated_at }}</p>
</div>