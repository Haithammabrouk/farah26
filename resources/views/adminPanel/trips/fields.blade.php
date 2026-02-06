<!-- Trip Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('trip_category_id', __('models/trips.fields.trip_category').':') !!}
    {!! Form::select('trip_category_id', $tripCategories, null, ['class' => 'form-control']) !!}
</div>

<!-- Check In Field -->
<div class="form-group col-sm-6">
    {!! Form::label('check_in', __('models/trips.fields.check_in').':') !!}
    {!! Form::text('check_in', null, ['class' => 'form-control datetimepicker']) !!}
</div>

<!-- Check Out Field -->
<div class="form-group col-sm-6">
    {!! Form::label('check_out', __('models/trips.fields.check_out').':') !!}
    {!! Form::text('check_out', null, ['class' => 'form-control datetimepicker']) !!}
</div>

<!-- Cabin Count Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cabin_count', __('models/trips.fields.cabin_count').':') !!}
    {!! Form::text('cabin_count', null, ['class' => 'form-control']) !!}
</div>

<!-- Suite Count Field -->
<div class="form-group col-sm-6">
    {!! Form::label('suite_count', __('models/trips.fields.suite_count').':') !!}
    {!! Form::text('suite_count', null, ['class' => 'form-control']) !!}
</div>

<!-- Cabin Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cabin_price', __('models/trips.fields.cabin_price').':') !!}
    {!! Form::text('cabin_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Suite Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('suite_price', __('models/trips.fields.suite_price').':') !!}
    {!! Form::text('suite_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Single Cabin Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('single_cabin_price', __('models/trips.fields.single_cabin_price').':') !!}
    {!! Form::text('single_cabin_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Single Suite Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('single_suite_price', __('models/trips.fields.single_suite_price').':') !!}
    {!! Form::text('single_suite_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Closed Cabin Field -->
@php
    $cabins = [
        401, 402, 403, 404, 405, 406, 407, 408, 409, 410, 411, 412, 413, 
        414, 415, 416, 417, 418, 419, 420, 421, 422, 423, 424, 425, 426, 
        301, 302, 303, 304, 305, 306, 307, 308, 309, 310, 311, 312, 313, 
        314, 315, 316, 317, 318, 319, 320, 321, 322, 323, 324, 325, 326, 
        201, 202, 203, 204, 205, 206, 101, 102, 103, 104, 105, 106
    ];
@endphp
<div class="form-group col-sm-6">

    {!! Form::label('closed_cabins', 'Open Cabins:') !!}
    <select name="closed_cabins[][cabin_num]" class="form-control select2" multiple="multiple">
        @foreach ($cabins as $cabin)
            <option
                value="{{ $cabin }}"
                {{ isset($closedCabins) && in_array($cabin, $closedCabins) ? 'selected' : '' }}
                {{ isset($accommodations) && in_array($cabin, $accommodations) ? 'disabled' : '' }}
            >
                {{ $cabin }}
            </option>
        @endforeach
    </select>
</div>

<!-- Closed Cabin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('additional_trips', __('models/trips.fields.additional_trips').':') !!}
    <select name="additional_trips[]" class="form-control select2" multiple="multiple">
        @foreach ($additionalTrips as $additionalTrip)
            <option
                value="{{ $additionalTrip->id }}"
                {{ isset($tripsAdditionals) && in_array($additionalTrip->id, $tripsAdditionals) ? 'selected' : '' }}
            >
                {{ $additionalTrip->name }}
            </option>
        @endforeach
    </select>
</div>

<!-- Is Home Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_home', __('models/trips.fields.is_home').':') !!}
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
    <a href="{{ route('adminPanel.trips.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
