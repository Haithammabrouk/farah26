<div class="table-responsive-sm">
    <table class="table table-striped" id="itineraries-table">
        <thead>
            <tr>
                <th>@lang('models/itineraries.fields.trip_category_id')</th>
        <th>@lang('models/itineraries.fields.day')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
        @foreach($itineraries as $itineraries)
            <tr>
                <td>{{ $itineraries->tripCategory->name }}</td>
            <td>{{ $itineraries->day }}</td>
                <td>
                    {!! Form::open(['route' => ['adminPanel.itineraries.destroy', $itineraries->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminPanel.itineraries.show', [$itineraries->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('adminPanel.itineraries.edit', [$itineraries->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>