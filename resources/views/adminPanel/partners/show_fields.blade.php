<!-- Photo Field -->
<div class="form-group">
    {!! Form::label('photo', __('models/partners.fields.photo').':') !!}
    <td><img src="{{$partner->photo}}" style="height: 150px" /></td>
</div>

<!-- Url Field -->
<div class="form-group">
    {!! Form::label('url', __('models/partners.fields.url').':') !!}
    <p>{{ $partner->url }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/partners.fields.created_at').':') !!}
    <p>{{ $partner->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/partners.fields.updated_at').':') !!}
    <p>{{ $partner->updated_at }}</p>
</div>
