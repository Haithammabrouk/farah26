
<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/users.fields.id').':') !!}
    <p>{{ $user->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/users.fields.name').':') !!}
    <p>{{ $user->title .' '. $user->first_name .' '. $user->last_name }}</p>
</div>

<!-- Country Field -->
<div class="form-group">
    {!! Form::label('country', __('models/users.fields.country').':') !!}
    <p>{{ $user->country->name }}</p>
</div>

<!-- Mobile Field -->
<div class="form-group">
    {!! Form::label('mobile', __('models/users.fields.mobile').':') !!}
    <p>{{ $user->mobile }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', __('models/users.fields.email').':') !!}
    <p>{{ $user->email }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/users.fields.created_at').':') !!}
    <p>{{ $user->created_at }}</p>
</div>

