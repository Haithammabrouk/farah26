<div class="table-responsive-sm">
    <table class="table table-striped" id="tripCategories-table">
        <thead>
            <tr>
                <th>@lang('models/tripCategories.fields.id')</th>
                <th>@lang('models/tripCategories.fields.lang')</th>
                <th>@lang('models/tripCategories.fields.name')</th>
                <th>@lang('models/tripCategories.fields.duration')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tripCategories as $tripCategory)
            @php $i = 1; @endphp
            @foreach(config('langs') as $locale => $name)
            <tr>
                <td>
                    @if($i == 1)
                    {{ $tripCategory->id }}
                    @endif
                </td>
                <td>{{ $name }}</td>
                <td>{{ $tripCategory->translateOrNew($locale)->name }}</td>
                <td>{{ $tripCategory->translateOrNew($locale)->duration }}</td>
                <td>
                    @if($i == 1)
                    {!! Form::open(['route' => ['adminPanel.tripCategories.destroy', $tripCategory->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminPanel.tripCategories.show', [$tripCategory->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('adminPanel.tripCategories.edit', [$tripCategory->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    </div>
                    {!! Form::close() !!}
                    @endif
                </td>
            </tr>
            @php $i = 0; @endphp
            @endforeach
            @endforeach
        </tbody>
    </table>
</div>
