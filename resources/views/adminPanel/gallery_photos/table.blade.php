<div class="table-responsive-sm">
    <table class="table table-striped" id="galleryPhotos-table">
        <thead>
            <tr>
                <th>@lang('models/galleryPhotos.fields.gallery_id')</th>
                <th>@lang('models/galleryPhotos.fields.photo')</th>
                <th>@lang('models/galleryPhotos.fields.is_home')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <thead style="background: #2f353a;">
            {!! Form::open(['route' => ['adminPanel.galleryPhotos.index'], 'method' => 'GET']) !!}
            <th>
                <select name="gallery_id" class="form-control">
                    <option value="">Select</option>
                    @foreach ($galleries as $gallery)
                    <option value="{{ $gallery->id }}">
                        {{ $gallery->name }}
                    </option>
                    @endforeach
                </select>
            </th>
            <th></th>
            <th>
                <select name="is_home" class="form-control">
                    <option value=''>Select</option>
                    <option value={{1}}>Yes</option>
                    <option value={{0}}>No</option>
                </select>
            </th>
            <th>
                <div class='btn-group'>
                    {!! Form::button('<i class="fa fa-search"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-light']) !!}
                    <a href="{{route('adminPanel.galleryPhotos.index')}}" class="btn btn-ghost-light"><i class="fa fa-ban"></i></a>
                </div>
            </th>
            {!! Form::close() !!}
        </thead>
        <tbody>
            @foreach($galleryPhotos as $galleryPhoto)
            <tr>
                <td>{{ $galleryPhoto->gallery->name }}</td>
                <td>
                    @if ($galleryPhoto->photo)
                        <img src="{{$galleryPhoto->photo}}" style="height: 70px" />
                    @else
                        <a href="{{ $galleryPhoto->url }}" target="__blank">{{ $galleryPhoto->url }}</a>
                    @endif
                </td>
                <td>
                    @if($galleryPhoto->is_home == 1)
                    Yes
                    @else
                    No
                    @endif
                </td>
                <td>
                    {!! Form::open(['route' => ['adminPanel.galleryPhotos.destroy', $galleryPhoto->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminPanel.galleryPhotos.show', [$galleryPhoto->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('adminPanel.galleryPhotos.edit', [$galleryPhoto->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
