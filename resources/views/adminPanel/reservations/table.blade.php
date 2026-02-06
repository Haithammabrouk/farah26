<div class="table-responsive-sm">
    <table class="table table-striped" id="reservations-table">
        <thead>
            <tr>
                <th>@lang('models/reservations.fields.id')</th>
                <th>@lang('models/reservations.fields.trip')</th>
                <th>@lang('models/reservations.fields.user')</th>
                <th>@lang('models/reservations.fields.price')</th>
                <th>@lang('models/reservations.fields.status')</th>
                <th>@lang('models/reservations.fields.ip_address')</th>
                <th>@lang('models/reservations.fields.created_at')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
        @foreach($reservations as $reservation)
            <tr>
                <td>
                    {{ $reservation->uuid }}
                </td>
                <td>
                    <a href="{{ route('adminPanel.trips.show', $reservation->trip_id) }}">
                        {{ $reservation->trip->tripCategory->name }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('adminPanel.users.show', $reservation->user_id) }}">
                        {{ $reservation->user->first_name .' '. $reservation->user->last_name }}
                    </a>
                </td>
                <td>{{ $reservation->price }}</td>
                <td>
                    @if ($reservation->status === 1)
                        @lang('models/reservations.fields.success')
                    @elseif ($reservation->status === 0)
                        @lang('models/reservations.fields.failed')
                    @else
                        @lang('models/reservations.fields.pending')
                    @endif
                </td>
                <td>{{ $reservation->ip_address }}</td>
                <td>{{ $reservation->created_at }}</td>
                <td>
                    {!! Form::open(['route' => ['adminPanel.reservations.destroy', $reservation->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminPanel.reservations.show', [$reservation->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        {{-- <a href="{{ route('adminPanel.reservations.edit', [$reservation->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!} --}}
                    </div>
                    {!! Form::close() !!}
                    @if ($reservation->status === 0)
                        <div class='btn-group'>
                            <!--{{$reservation->id}}-->
                            <!--deletereservations-->
                            <a href="{{ route('deletereservations' ,$reservation->id ) }}" class='btn btn-ghost-danger'><i class="fa fa-trash-o"></i></a>
                        </div>
                    @endif
                    
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>