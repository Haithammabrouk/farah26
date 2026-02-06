<div class="table-responsive-sm">
    <table class="table table-striped" id="uniques-table">
        <thead>
            <tr>
                <th>@lang('models/uniques.fields.id')</th>
                <th>@lang('models/uniques.fields.lang')</th>
                <th>@lang('models/uniques.fields.title')</th>
                <th>@lang('models/uniques.fields.text')</th>
                <th>@lang('models/uniques.fields.photo')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($uniques as $unique)
            @php $i = 1; @endphp
            @foreach ( config('langs') as $locale => $name)
            <tr>
                <td>
                    @if($i == 1)
                    {{ $unique->id }}
                    @endif
                </td>
                <td>{{ $name }}</td>
                <td>{{ $unique->translateOrNew($locale)->title }}</td>
                <td>{{ Str::limit($unique->translateOrNew($locale)->text, 20) }}</td>
                <td>
                    @if($i == 1)
                    <img src="{{$unique->photo}}" style="height: 70px" />
                    @endif
                </td>
                <td>
                    @if($i == 1)
                    {!! Form::open(['route' => ['adminPanel.uniques.destroy', $unique->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminPanel.uniques.show', [$unique->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('adminPanel.uniques.edit', [$unique->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {{-- {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!} --}}
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
