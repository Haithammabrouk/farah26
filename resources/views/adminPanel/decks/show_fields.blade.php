<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/decks.fields.id').':') !!}
    <p>{{ $deck->id }}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', __('models/decks.fields.title').':') !!}
    <p>{{ $deck->title }}</p>
</div>

<!-- File Field -->
<div class="form-group">
    {!! Form::label('file', __('models/decks.fields.file').':') !!}
    <img src="{{ asset($deck->file) }}" width="200" style="display: block;">
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/decks.fields.created_at').':') !!}
    <p>{{ $deck->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/decks.fields.updated_at').':') !!}
    <p>{{ $deck->updated_at }}</p>
</div>
