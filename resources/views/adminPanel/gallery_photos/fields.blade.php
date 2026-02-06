<!-- Gallery Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gallery_id', __('models/galleryPhotos.fields.gallery_id').':') !!}
    {!! Form::select('gallery_id', $galleries, null, ['class' => 'form-control']) !!}
</div>

<!-- Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('url', __('models/galleryPhotos.fields.url').':') !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
</div>

<!-- Photo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('photo', __('models/galleryPhotos.fields.photo').':') !!}
    {!! Form::file('photo') !!}
    @if (isset($galleryPhoto) && $galleryPhoto->photo)
    <img src="{{ asset($galleryPhoto->photo) }}" width="200">
    @endif
</div>
<div class="clearfix"></div>

<!-- Is Home Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_home', __('models/galleryPhotos.fields.is_home').':') !!}
    <label class="radio-inline">
        {!! Form::radio('is_home', "1", null) !!} Yes
    </label>
    <label class="radio-inline">
        {!! Form::radio('is_home', "0", true) !!} No
    </label>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.galleryPhotos.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
