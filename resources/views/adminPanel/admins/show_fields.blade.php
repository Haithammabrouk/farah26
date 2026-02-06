<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/admins.fields.id').':') !!}
    <p>{{ $admin->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/admins.fields.name').':') !!}
    <p>{{ $admin->name }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', __('models/admins.fields.email').':') !!}
    <p>{{ $admin->email }}</p>
</div>

<!-- Password Field -->
<div class="form-group">
    {!! Form::label('password', __('models/admins.fields.password').':') !!}
    <p>{{ $admin->password }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/admins.fields.status').':') !!}
    <p>{{ $admin->status }}</p>
</div>

<!-- Remember Token Field -->
<div class="form-group">
    {!! Form::label('remember_token', __('models/admins.fields.remember_token').':') !!}
    <p>{{ $admin->remember_token }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/admins.fields.created_at').':') !!}
    <p>{{ $admin->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/admins.fields.updated_at').':') !!}
    <p>{{ $admin->updated_at }}</p>
</div>

