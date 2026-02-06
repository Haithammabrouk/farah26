<div class="table-responsive-sm">
    <table class="table table-striped" id="additionalTripsPhotos-table">
        <thead>
            <tr>
                <th>@lang('models/additionalTripsPhotos.fields.photo')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($additionalTripsPhotos as $additionalTripsPhoto)
            <tr>

                <td><img src="{{$additionalTripsPhoto->photo}}" style="height: 70px" /></td>
                <td>
                    {!! Form::open(['route' => ['adminPanel.additionalTripsPhotos.destroy', $additionalTripsPhoto->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminPanel.additionalTripsPhotos.show', [$additionalTripsPhoto->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('adminPanel.additionalTripsPhotos.edit', [$additionalTripsPhoto->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>