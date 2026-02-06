<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/galleryPhotos.fields.id').':') !!}
    <p>{{ $galleryPhoto->id }}</p>
</div>

<!-- Gallery Id Field -->
<div class="form-group">
    {!! Form::label('gallery_id', __('models/galleryPhotos.fields.gallery_id').':') !!}
    <p>{{ $galleryPhoto->gallery_id }}</p>
</div>

<!-- Photo Field -->
<div class="form-group">
    {!! Form::label('photo', __('models/galleryPhotos.fields.photo').':') !!}
    <p>
        @if ($galleryPhoto->photo)
            <img src="{{$galleryPhoto->photo}}" style="height: 70px" />
        @endif
    </p>
</div>

<!-- Url Field -->
<div class="form-group">
    {!! Form::label('url', __('models/galleryPhotos.fields.url').':') !!}
    <p>
        <a href="{{ $galleryPhoto->url }}" target="__blank">{{ $galleryPhoto->url }}</a>
    </p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/galleryPhotos.fields.created_at').':') !!}
    <p>{{ $galleryPhoto->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/galleryPhotos.fields.updated_at').':') !!}
    <p>{{ $galleryPhoto->updated_at }}</p>
</div>