<!-- Facility Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('facility_id', __('models/facilityPhotos.fields.facility_title').':') !!}
    {!! Form::select('facility_id', $facility, null, ['class' => 'form-control']) !!}
</div>

<!-- Photo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('photo', __('models/facilityPhotos.fields.photo').':') !!}
    {!! Form::file('photo') !!}
    @if (isset($facilityPhoto))
    <img src="{{ asset($facilityPhoto->photo) }}" width="200">
    @endif
</div>
<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.facilityPhotos.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>