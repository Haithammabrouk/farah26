<div class="table-responsive-sm">
    <table class="table table-striped" id="pages-table">
        <thead>
            <th>@lang('models/pages.fields.id')</th>
            <th>@lang('models/pages.fields.language')</th>
            <th>@lang('models/pages.fields.name')</th>
            <th colspan="3">@lang('crud.action')</th>
        </thead>
        <thead style="background: #2f353a;">
            {!! Form::open(['route' => ['adminPanel.pages.index'], 'method' => 'GET']) !!}

            <th>
                {!! Form::text('id', request()->filled('id')? old('id', request('id')) : null, ['class' => 'form-control', 'placeholder' => 'Search by ID']) !!}
            </th>
            <th>

            </th>
            <th>
                {!! Form::text('name', request()->filled('name')? old('name', request('name')) : null, ['class' => 'form-control', 'placeholder' => 'Search by Name']) !!}
            </th>
            <th>
                <div class='btn-group'>
                    {!! Form::button('<i class="fa fa-search"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-light']) !!}
                    <a href="{{route('adminPanel.pages.index')}}" class="btn btn-ghost-light"><i class="fa fa-ban"></i></a>
                </div>
            </th>

            {!! Form::close() !!}
        </thead>
        <tbody>
            @foreach($pages as $page)
            @php $i = 1; @endphp
            @foreach ( config('langs') as $locale => $name)
            <tr>
                <td>
                    @if($i == 1)
                    {{ $page->id }}
                    @endif
                </td>
                <td>{{ $name }}</td>
                <td>{{ $page->translateOrNew($locale)->name }}</td>
                <td>
                    @if($i == 1)
                    {!! Form::open(['route' => ['adminPanel.pages.destroy', $page->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('pages view')
                        <a href="{{ route('adminPanel.pages.show', [$page->id]) }}" class='btn btn-ghost-success'>
                            <i class="fa fa-eye"></i>
                        </a>
                        @endcan
                        @can('pages edit')
                        <a href="{{ route('adminPanel.pages.edit', [$page->id]) }}" class='btn btn-ghost-info'>
                            <i class="fa fa-edit"></i>
                        </a>
                        @endcan
                        {{-- @can('pages destroy')
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                        @endcan --}}
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
