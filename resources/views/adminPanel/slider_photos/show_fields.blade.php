<!-- Photo Field -->
<div class="form-group">
    {!! Form::label('photo', __('models/sliderPhotos.fields.photo').':') !!}
    <img src="{{$sliderPhoto->photo}}" alt="" style="height: 200px; display: block;" />
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/sliderPhotos.fields.created_at').':') !!}
    <p>{{ $sliderPhoto->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/sliderPhotos.fields.updated_at').':') !!}
    <p>{{ $sliderPhoto->updated_at }}</p>
</div>
