<div class="table-responsive-sm">
    <table class="table table-striped" id="contactuses-table">
        <thead>
            <tr>
                <th>@lang('models/contactuses.fields.name')</th>
        <th>@lang('models/contactuses.fields.email')</th>
        <th>@lang('models/contactuses.fields.mobile')</th>
        <th>@lang('models/contactuses.fields.message')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
        @foreach($contactuses as $contactus)
            <tr>
                <td>{{ $contactus->name }}</td>
            <td>{{ $contactus->email }}</td>
            <td>{{ $contactus->mobile }}</td>
            <td>{{ $contactus->message }}</td>
                <td>
                    {!! Form::open(['route' => ['adminPanel.contactuses.destroy', $contactus->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminPanel.contactuses.show', [$contactus->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        {{-- <a href="{{ route('adminPanel.contactuses.edit', [$contactus->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a> --}}
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>