<div class="table-responsive-sm">
    <table class="table table-striped" id="partners-table">
        <thead>
            <tr>
                <th>@lang('models/partners.fields.photo')</th>
                <th>@lang('models/partners.fields.url')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($partners as $partner)
            <tr>
                <td><img src="{{$partner->photo}}" style="height: 70px" /></td>
                <td>{{$partner->url}}</td>
                <td>
                    {!! Form::open(['route' => ['adminPanel.partners.destroy', $partner->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminPanel.partners.show', [$partner->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('adminPanel.partners.edit', [$partner->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
