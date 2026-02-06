<div class="table-responsive-sm">
    <table class="table table-striped" id="facilityPhotos-table">
        <thead>
            <tr>
                <th>@lang('models/facilityPhotos.fields.facility_title')</th>
                <th>@lang('models/facilityPhotos.fields.photo')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <thead style="background: #2f353a;">
            {!! Form::open(['route' => ['adminPanel.facilityPhotos.index'], 'method' => 'GET']) !!}
            <th>
                <select name="facility_id" class="form-control">
                    <option value="">Select</option>
                    @foreach ($facilities as $facility)
                    <option value="{{ $facility->id }}">
                        {{ $facility->name }}
                    </option>
                    @endforeach
                </select>
            </th>
            <th></th>
            <th>
                <div class='btn-group'>
                    {!! Form::button('<i class="fa fa-search"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-light']) !!}
                    <a href="{{route('adminPanel.facilityPhotos.index')}}" class="btn btn-ghost-light"><i class="fa fa-ban"></i></a>
                </div>
            </th>
            {!! Form::close() !!}
        </thead>
        <tbody>
            @foreach($facilityPhotos as $facilityPhoto)
            <tr>
                <td>{{ $facilityPhoto->facility->name }}</td>
                <td><img src="{{$facilityPhoto->photo}}" style="height: 70px" /></td>
                <td>
                    {!! Form::open(['route' => ['adminPanel.facilityPhotos.destroy', $facilityPhoto->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminPanel.facilityPhotos.show', [$facilityPhoto->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('adminPanel.facilityPhotos.edit', [$facilityPhoto->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
