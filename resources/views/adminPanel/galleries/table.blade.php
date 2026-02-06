<div class="table-responsive-sm">
    <table class="table table-striped" id="galleries-table">
        <thead>
            <tr>
                <th>@lang('models/galleries.fields.name')</th>
                <th>@lang('models/galleries.fields.status')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($galleries as $gallery)
            <tr>
                <td>{{ $gallery->name }}</td>
                <td>{{ $gallery->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    {!! Form::open(['route' => ['adminPanel.galleries.destroy', $gallery->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminPanel.galleries.show', [$gallery->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('adminPanel.galleries.edit', [$gallery->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        @if($gallery->id != 9 && $gallery->id != 10 && $gallery->id != 11 && $gallery->id != 12 && $gallery->id != 7 )
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                        @endif
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
