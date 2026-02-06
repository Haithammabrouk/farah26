<div class="table-responsive-sm">
    <table class="table table-striped" id="trips-table">
        <thead>
            <tr>
                <th>@lang('models/trips.fields.trip_category')</th>
                <th>@lang('models/trips.fields.check_in')</th>
                <th>@lang('models/trips.fields.check_out')</th>
                <th>@lang('models/trips.fields.cabin_count')</th>
                <th>@lang('models/trips.fields.suite_count')</th>
                <th>@lang('models/trips.fields.cabin_price')</th>
                <th>@lang('models/trips.fields.suite_price')</th>
                <th>@lang('models/trips.fields.cabin_available')</th>
                <th>@lang('models/trips.fields.suite_available')</th>
                <th>@lang('models/trips.fields.is_home')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
        @foreach($trips as $trip)
            <tr>
                <td>{{ $trip->tripCategory->name }}</td>
                <td>{{ $trip->check_in }}</td>
                <td>{{ $trip->check_out }}</td>
                <td>{{ $trip->cabin_count }}</td>
                <td>{{ $trip->suite_count }}</td>
                <td>{{ $trip->cabin_price }}</td>
                <td>{{ $trip->suite_price }}</td>
                <td>{{ $trip->cabin_available }}</td>
                <td>{{ $trip->suite_available }}</td>
                <td>{{ $trip->is_home ? 'Yes' : 'No' }}</td>
                <td>
                    {!! Form::open(['route' => ['adminPanel.trips.destroy', $trip->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminPanel.trips.show', [$trip->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('adminPanel.trips.edit', [$trip->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    </div>
                    {!! Form::close() !!}
                    
                 
                    
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>