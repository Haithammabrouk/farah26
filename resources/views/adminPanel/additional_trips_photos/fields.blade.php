<!-- Additional Trip Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('additional_trip_id', __('models/additionalTripsPhotos.fields.trip_name').':') !!}
    {!! Form::select('additional_trip_id', $additionalTrips, null, ['class' => 'form-control']) !!}
</div>

<!-- Photo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('photo', __('models/additionalTripsPhotos.fields.photo').':') !!}
    {!! Form::file('photo') !!}
    @if (isset($additionalTripsPhotos))
    <img src="{{ asset($additionalTripsPhotos->photo) }}" width="200">
    @endif
</div>
<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.additionalTripsPhotos.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>