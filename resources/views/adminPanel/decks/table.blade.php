<div class="table-responsive-sm">
    <table class="table table-striped" id="decks-table">
        <thead>
            <tr>
                <th>@lang('models/decks.fields.title')</th>
                <th>@lang('models/decks.fields.file')</th>
                {{-- <th>@lang('models/decks.fields.other_file')</th> --}}
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($decks as $deck)
            <tr>
                <td>{{ $deck->title }}</td>
                <td><img src="{{$deck->file}}" style="height: 70px" /></td>
                {{-- <td><img src="{{ $deck->other_file}}" style="height: 70px" /></td> --}}
                <td>
                    {!! Form::open(['route' => ['adminPanel.decks.destroy', $deck->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminPanel.decks.show', [$deck->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('adminPanel.decks.edit', [$deck->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
