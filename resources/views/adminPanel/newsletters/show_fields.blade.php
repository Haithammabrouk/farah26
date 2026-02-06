<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/newsletters.fields.id').':') !!}
    <p>{{ $newsletter->id }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', __('models/newsletters.fields.email').':') !!}
    <p>{{ $newsletter->email }}</p>
</div>

