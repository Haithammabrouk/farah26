<div class="table-responsive-sm">
    <table class="table table-striped" id="tripadvisors-table">
        <thead>
            <tr>
                <th>@lang('models/tripadvisors.fields.id')</th>
                <th>@lang('models/tripadvisors.fields.lang')</th>
                <th>@lang('models/tripadvisors.fields.title')</th>
                <th>@lang('models/tripadvisors.fields.text')</th>
                <th>@lang('models/tripadvisors.fields.author')</th>
                <th>@lang('models/tripadvisors.fields.url')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tripadvisors as $tripadvisor)
            @php $i = 1; @endphp
            @foreach(config('langs') as $locale => $name)
            <tr>
                <td>
                    @if($i == 1)
                    {{ $tripadvisor->id }}
                    @endif
                </td>
                <td>{{ $name }}</td>
                <td>{{ $tripadvisor->translateOrNew($locale)->title }}</td>
                <td>{{ Str::limit($tripadvisor->translateOrNew($locale)->text, 20) }}</td>
                <td>
                    @if($i == 1)
                    {{ $tripadvisor->author }}
                    @endif
                </td>
                <td>
                    @if($i == 1)
                    <a href="{{$tripadvisor->url }}" target="_blank">View Link</a>
                    @endif
                <td>
                    @if($i == 1)
                    {!! Form::open(['route' => ['adminPanel.tripadvisors.destroy', $tripadvisor->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminPanel.tripadvisors.show', [$tripadvisor->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('adminPanel.tripadvisors.edit', [$tripadvisor->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
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
