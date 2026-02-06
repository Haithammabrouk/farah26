<div class="table-responsive-sm">
    <table class="table table-striped" id="additionalTrips-table">
        <thead>
            <tr>
                <th>@lang('models/additionalTrips.fields.id')</th>
                <th>@lang('models/additionalTrips.fields.lang')</th>
                <th>@lang('models/additionalTrips.fields.name')</th>
                <th>@lang('models/additionalTrips.fields.location')</th>
                <th>@lang('models/additionalTrips.fields.price')</th>
                <th>@lang('models/additionalTrips.fields.SinglePrice')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($additionalTrips as $additionalTrip)
            @php $i = 1; @endphp
            @foreach(config('langs') as $locale => $name)
            <tr>
                <td>
                    @if($i == 1)
                    {{ $additionalTrip->id }}
                    @endif
                </td>
                <td>{{ $name }}</td>
                <td>{{ $additionalTrip->translateOrNew($locale)->name }}</td>
                <td>{{ $additionalTrip->translateOrNew($locale)->location }}</td>
                <td>
                    @if($i == 1)
                    {{ $additionalTrip->price }}
                    @endif
                </td>
                <td>
                    @if($i == 1)
                    {{ $additionalTrip->SinglePrice }}
                    @endif
                </td>
                <td>
                    @if($i == 1)
                    {!! Form::open(['route' => ['adminPanel.additionalTrips.destroy', $additionalTrip->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminPanel.additionalTrips.show', [$additionalTrip->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('adminPanel.additionalTrips.edit', [$additionalTrip->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    </div>
                    {!! Form::close() !!}
                    @endif
                </td>
            </tr>
            @php $i = 0; @endphp
            @endforeach
            @endforeach
        </tbody>
    </table>
</div>
