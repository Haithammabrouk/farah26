<!-- Photo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('photo', __('models/sliderPhotos.fields.photo').':') !!}
    {!! Form::file('photo') !!}
</div>
<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.sliderPhotos.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
