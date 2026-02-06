<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/trips.fields.id').':') !!}
    <p>{{ $trip->id }}</p>
</div>

<!-- Trip Category Field -->
<div class="form-group">
    {!! Form::label('trip_category', __('models/trips.fields.trip_category').':') !!}
    <p>{{ $trip->tripCategory->name }}</p>
</div>

<!-- Check In Field -->
<div class="form-group">
    {!! Form::label('check_in', __('models/trips.fields.check_in').':') !!}
    <p>{{ $trip->check_in }}</p>
</div>

<!-- Check Out Field -->
<div class="form-group">
    {!! Form::label('check_out', __('models/trips.fields.check_out').':') !!}
    <p>{{ $trip->check_out }}</p>
</div>

<!-- Cabin Count Field -->
<div class="form-group">
    {!! Form::label('cabin_count', __('models/trips.fields.cabin_count').':') !!}
    <p>{{ $trip->cabin_count }}</p>
</div>

<!-- Suite Count Field -->
<div class="form-group">
    {!! Form::label('suite_count', __('models/trips.fields.suite_count').':') !!}
    <p>{{ $trip->suite_count }}</p>
</div>

<!-- Cabin Price Field -->
<div class="form-group">
    {!! Form::label('cabin_price', __('models/trips.fields.cabin_price').':') !!}
    <p>{{ $trip->cabin_price }}</p>
</div>

<!-- Suite Price Field -->
<div class="form-group">
    {!! Form::label('suite_price', __('models/trips.fields.suite_price').':') !!}
    <p>{{ $trip->suite_price }}</p>
</div>

<!-- Cabin Available Field -->
<div class="form-group">
    {!! Form::label('cabin_available', __('models/trips.fields.cabin_available').':') !!}
    <p>{{ $trip->cabin_available }}</p>
</div>

<!-- Suite Available Field -->
<div class="form-group">
    {!! Form::label('suite_available', __('models/trips.fields.suite_available').':') !!}
    <p>{{ $trip->suite_available }}</p>
</div>

<!-- Closed Cabin Field -->
<div class="form-group">
    {!! Form::label('closed_cabins', "Opend Cabins".':') !!}
    <p>
    @foreach ($trip->closedCabins as $closedCabin)
        {{ $closedCabin->cabin_num .' , ' }}
    @endforeach
    </p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/trips.fields.created_at').':') !!}
    <p>{{ $trip->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/trips.fields.updated_at').':') !!}
    <p>{{ $trip->updated_at }}</p>
</div>

