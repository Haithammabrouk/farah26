<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/infos.fields.id').':') !!}
    <p>{{ $info->id }}</p>
</div>

<!-- Key Field -->
<div class="form-group">
    {!! Form::label('key', __('models/infos.fields.key').':') !!}
    <p>{{ $info->key }}</p>
</div>

<!-- Value Field -->
<div class="form-group">
    {!! Form::label('value', __('models/infos.fields.value').':') !!}
    <p>{{ $info->value }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/infos.fields.created_at').':') !!}
    <p>{{ $info->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/infos.fields.updated_at').':') !!}
    <p>{{ $info->updated_at }}</p>
</div>

