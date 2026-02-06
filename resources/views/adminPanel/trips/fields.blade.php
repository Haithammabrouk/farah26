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

<!-- Open Cabins Field (Enhanced UX) -->
@php
    $cabins = [
        'Deck 4 - Suites' => [401, 402],
        'Deck 4 - Standard' => [403, 404, 405, 406, 407, 408, 409, 410, 411, 412, 413, 414, 415, 416, 417, 418, 419, 420, 421, 422, 423, 424, 425, 426],
        'Deck 3' => [301, 302, 303, 304, 305, 306, 307, 308, 309, 310, 311, 312, 313, 314, 315, 316, 317, 318, 319, 320, 321, 322, 323, 324, 325, 326],
        'Deck 2' => [201, 202, 203, 204, 205, 206],
        'Deck 1' => [101, 102, 103, 104, 105, 106],
    ];
    $suiteNumbers = [401, 402];
@endphp

<div class="form-group col-sm-12">
    <div class="card border-info">
        <div class="card-header bg-info text-white">
            <i class="fas fa-door-open"></i>
            <strong>Select Open/Available Cabins for This Trip</strong>
        </div>
        <div class="card-body">
            <div class="alert alert-info mb-3">
                <i class="fas fa-info-circle"></i>
                <strong>Instructions:</strong> Select which cabins are OPEN for booking on this trip.
                <br>
                <span class="badge badge-warning">Suites (401, 402)</span> are marked in gold.
                <span class="badge badge-danger">Already booked cabins</span> are disabled.
            </div>

            {!! Form::label('closed_cabins', 'Available Cabins:') !!}
            <select name="closed_cabins[][cabin_num]"
                    id="closed_cabins"
                    class="form-control select2-cabins"
                    multiple="multiple">
                @foreach ($cabins as $deckName => $cabinList)
                    <optgroup label="{{ $deckName }}">
                        @foreach ($cabinList as $cabin)
                            <option
                                value="{{ $cabin }}"
                                {{ isset($closedCabins) && in_array($cabin, $closedCabins) ? 'selected' : '' }}
                                {{ isset($accommodations) && in_array($cabin, $accommodations) ? 'disabled' : '' }}
                                data-suite="{{ in_array($cabin, $suiteNumbers) ? 'true' : 'false' }}"
                            >
                                {{ $cabin }}{{ in_array($cabin, $suiteNumbers) ? ' (Suite)' : '' }}
                            </option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>

            <small class="form-text text-muted mt-2">
                <i class="fas fa-lightbulb"></i>
                <strong>Tip:</strong> Use Ctrl+Click (Cmd+Click on Mac) to select multiple cabins.
                Disabled cabins are already booked and cannot be changed.
            </small>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Enhanced Select2 for cabins
    $('.select2-cabins').select2({
        closeOnSelect: false,
        width: '100%',
        placeholder: 'Select cabins to open for booking',
        templateResult: formatCabinOption,
        templateSelection: formatCabinSelection
    });

    function formatCabinOption(option) {
        if (!option.id) return option.text;

        var $option = $(option.element);
        var isSuite = $option.data('suite') === 'true';
        var isDisabled = $option.is(':disabled');

        var $result = $('<span></span>');
        $result.text(option.text);

        if (isSuite) {
            $result.css('color', '#f39c12').css('font-weight', 'bold');
            $result.prepend('<i class="fas fa-crown" style="margin-right: 5px;"></i>');
        }

        if (isDisabled) {
            $result.css('color', '#dc3545').css('text-decoration', 'line-through');
            $result.append(' <i class="fas fa-lock" style="margin-left: 5px;"></i>');
        }

        return $result;
    }

    function formatCabinSelection(option) {
        if (!option.id) return option.text;

        var $option = $(option.element);
        var isSuite = $option.data('suite') === 'true';

        if (isSuite) {
            return $('<span style="color: #f39c12; font-weight: bold;"><i class="fas fa-crown"></i> ' + option.text + '</span>');
        }

        return option.text;
    }
});
</script>
@endpush

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
