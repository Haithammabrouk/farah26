<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/galleries.fields.id').':') !!}
    <p>{{ $gallery->id }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/galleries.fields.status').':') !!}
    <p>{{ $gallery->status }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/galleries.fields.created_at').':') !!}
    <p>{{ $gallery->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/galleries.fields.updated_at').':') !!}
    <p>{{ $gallery->updated_at }}</p>
</div>

