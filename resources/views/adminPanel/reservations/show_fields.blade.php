<!-- Id Field -->

<div class="form-group">
    {!! Form::label('id', __('models/reservations.fields.id').':') !!}
    <p>{{ $reservation->id }}</p>
</div>

<!-- Trip Field -->
<div class="form-group">
    {!! Form::label('trip', __('models/reservations.fields.trip').':') !!}
    <p>{{ $reservation->trip->tripCategory->name }}</p>
</div>

<div class="form-group">
    <label for="">check in</label>
    <p>{{ $dates->check_in }}</p>
</div>

<div class="form-group">
    <label for="">check out</label>
    <p>{{ $dates->check_out }}</p>
</div>

<!-- User Field -->
<div class="form-group">
    {!! Form::label('user', __('models/reservations.fields.user').':') !!}
    <p>{{ $reservation->user->first_name .' '. $reservation->user->last_name }}</p>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', __('models/reservations.fields.price').':') !!}
    <p>{{ $reservation->price }}</p>
</div>

<!-- Comment Field -->
<div class="form-group">
    {!! Form::label('comment', __('models/reservations.fields.comment').':') !!}
    <p>{{ $reservation->comment }}</p>
</div>

<!-- Status Field -->
{{-- <div class="form-group">
    {!! Form::label('status', __('models/reservations.fields.status').':') !!}
    <p>{{ $reservation->status }}</p>
</div> --}}

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/reservations.fields.created_at').':') !!}
    <p>{{ $reservation->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/reservations.fields.updated_at').':') !!}
    <p>{{ $reservation->updated_at }}</p>
</div>

<br>
<hr>
<h3>Accommodations</h3>
<hr>

<div class="table-responsive-sm">
    <table class="table table-striped" id="reservations-table">
        <thead>
            <tr>
                <th>@lang('models/reservations.fields.type')</th>
                <th>@lang('models/reservations.fields.cabin_suite_price')</th>
                <th>@lang('models/reservations.fields.accommodation_num')</th>
                <th>@lang('models/reservations.fields.guest_name')</th>
                <th>@lang('models/reservations.fields.adults_count')</th>
                <th>@lang('models/reservations.fields.children_count')</th>
                <th>@lang('models/reservations.fields.child1_age')</th>
                <th>@lang('models/reservations.fields.child2_age')</th>
                <th>@lang('models/reservations.fields.total_price')</th>
            </tr>
        </thead>
        <tbody>
        @foreach($reservation->accommodations as $accommodation)
            <tr>
                <td>{{ $accommodation->type == 1 ? 'cabin' : 'suite' }}</td>
                <td>
                    @if ($accommodation->type == 1)
                        {{ $accommodation->cabin_price .' / '. $accommodation->single_cabin_price }}
                    @else
                        {{ $accommodation->suite_price .' / '. $accommodation->single_suite_price }}
                    @endif
                </td>
                <td>{{ $accommodation->accommodation_num }}</td>
                <td>{{ $accommodation->guest_name }}</td>
                <td>{{ $accommodation->adults_count }}</td>
                <td>{{ $accommodation->children_count }}</td>
                <td>
                    @if ($accommodation->child1_age)
                        {{ $accommodation->child1_age == 1 ? 'free' : '25%' }}
                    @else
                        __
                    @endif
                </td>
                <td>
                    @if ($accommodation->child2_age)
                        {{ $accommodation->child2_age == 1 ? 'free' : '25%' }}
                    @else
                        __
                    @endif
                </td>
                <td>{{ $accommodation->total_price }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<br>
<hr>
<h3>Additional Trips</h3>
<hr>

<div class="table-responsive-sm">
    <table class="table table-striped" id="reservations-table">
        <thead>
            <tr>
                <th>@lang('models/reservations.fields.trip')</th>
                <th>@lang('models/reservations.fields.price')</th>
                <th>@lang('models/reservations.fields.adults_count')</th>
                <th>@lang('models/reservations.fields.child1_count')</th>
                <th>@lang('models/reservations.fields.child2_count')</th>
                <th>@lang('models/reservations.fields.total_price')</th>
            </tr>
        </thead>
        <tbody>
        @foreach($reservation->reservedAdditionalTrips as $aTrip)
            <tr>
                <td>{{ $aTrip->additionalTrip->name }}</td>
                <td>{{ $aTrip->price }}</td>
                <td>{{ $aTrip->adults_count }}</td>
                <td>{{ $aTrip->child1_count }}</td>
                <td>{{ $aTrip->child2_count }}</td>
                <td>{{ $aTrip->total_price }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>