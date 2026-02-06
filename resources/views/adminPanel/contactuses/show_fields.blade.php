<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/contactuses.fields.id').':') !!}
    <p>{{ $contactus->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/contactuses.fields.name').':') !!}
    <p>{{ $contactus->name }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', __('models/contactuses.fields.email').':') !!}
    <p>{{ $contactus->email }}</p>
</div>

<!-- Mobile Field -->
<div class="form-group">
    {!! Form::label('mobile', __('models/contactuses.fields.mobile').':') !!}
    <p>{{ $contactus->mobile }}</p>
</div>

<!-- Message Field -->
<div class="form-group">
    {!! Form::label('message', __('models/contactuses.fields.message').':') !!}
    <p>{{ $contactus->message }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/contactuses.fields.created_at').':') !!}
    <p>{{ $contactus->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/contactuses.fields.updated_at').':') !!}
    <p>{{ $contactus->updated_at }}</p>
</div>

