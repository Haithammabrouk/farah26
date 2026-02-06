<div class="table-responsive-sm">
    <table class="table table-striped" id="reservedAdditionalTrips-table">
        <thead>
            <tr>
                <th>@lang('models/reserved_additional_trips.fields.reservation_id')</th>
        <th>@lang('models/reserved_additional_trips.fields.additional_trip_id')</th>
        <th>@lang('models/reserved_additional_trips.fields.price')</th>
        <th>@lang('models/reserved_additional_trips.fields.adults_count')</th>
        <th>@lang('models/reserved_additional_trips.fields.child1_count')</th>
        <th>@lang('models/reserved_additional_trips.fields.child2_count')</th>
        <th>@lang('models/reserved_additional_trips.fields.total_price')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
        @foreach($reservedAdditionalTrips as $reservedAdditionalTrip)
            <tr>
                <td>{{ $reservedAdditionalTrip->reservation_id }}</td>
            <td>{{ $reservedAdditionalTrip->additional_trip_id }}</td>
            <td>{{ $reservedAdditionalTrip->price }}</td>
            <td>{{ $reservedAdditionalTrip->adults_count }}</td>
            <td>{{ $reservedAdditionalTrip->child1_count }}</td>
            <td>{{ $reservedAdditionalTrip->child2_count }}</td>
            <td>{{ $reservedAdditionalTrip->total_price }}</td>
                <td>
                    {!! Form::open(['route' => ['adminPanel.reservedAdditionalTrips.destroy', $reservedAdditionalTrip->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminPanel.reservedAdditionalTrips.show', [$reservedAdditionalTrip->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('adminPanel.reservedAdditionalTrips.edit', [$reservedAdditionalTrip->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>