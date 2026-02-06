<div class="table-responsive-sm">
    <table class="table table-striped" id="sliderPhotos-table">
        <thead>
            <tr>
                <th>@lang('models/sliderPhotos.fields.photo')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sliderPhotos as $sliderPhoto)
            <tr>
                <td>
                    <img src="{{$sliderPhoto->photo}}" alt="" style="height: 100px;" />
                </td>
                <td>
                    {!! Form::open(['route' => ['adminPanel.sliderPhotos.destroy', $sliderPhoto->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminPanel.sliderPhotos.show', [$sliderPhoto->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('adminPanel.sliderPhotos.edit', [$sliderPhoto->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
