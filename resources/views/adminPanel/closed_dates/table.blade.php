<div class="table-responsive-sm">
    <table class="table table-striped" id="closedDates-table">
        <thead>
            <tr>
                <th>@lang('models/closedDates.fields.date')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
        @foreach($closedDates as $closedDates)
            <tr>
                <td>{{ $closedDates->date }}</td>
                <td>
                    {!! Form::open(['route' => ['adminPanel.closedDates.destroy', $closedDates->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminPanel.closedDates.show', [$closedDates->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('adminPanel.closedDates.edit', [$closedDates->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>