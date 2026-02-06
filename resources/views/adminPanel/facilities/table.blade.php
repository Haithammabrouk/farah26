<div class="table-responsive-sm">
    <table class="table table-striped" id="facilities-table">
        <thead>
            <tr>
                <th>@lang('models/facilities.fields.id')</th>
                <th>@lang('models/facilities.fields.lang')</th>
                <th>@lang('models/facilities.fields.name')</th>
                <th>@lang('models/facilities.fields.img')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($facilities as $facility)
            @php $i = 1 @endphp
            @foreach(config('langs') as $locale => $name)
            <tr>
                <td>
                    @if($i == 1)
                    {{ $facility->id }}
                    @endif
                </td>
                <td>{{ $name }}</td>
                <td>{{ $facility->translateOrNew($locale)->name }}</td>
                <td>
                    @if($i == 1)
                    <img src="{{ $facility->img }}" height="70">
                    @endif
                </td>
                <td>
                    @if($i == 1)
                    {!! Form::open(['route' => ['adminPanel.facilities.destroy', $facility->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminPanel.facilities.show', [$facility->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('adminPanel.facilities.edit', [$facility->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    </div>
                    {!! Form::close() !!}
                    @endif
                </td>
            </tr>
            @php $i = 0 @endphp
            @endforeach
            @endforeach
        </tbody>
    </table>
</div>
