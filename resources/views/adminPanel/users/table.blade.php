<div class="table-responsive-sm">
    <table class="table table-striped " id="users-table">
        <thead>
            <th>@lang('models/users.fields.id')</th>
            <th>@lang('models/users.fields.name')</th>
            <th>@lang('models/users.fields.country')</th>
            <th>@lang('models/users.fields.mobile')</th>
            <th>@lang('models/users.fields.email')</th>
            <th>@lang('models/users.fields.created_at')</th>
            <th colspan="3">@lang('crud.action')</th>
        </thead>
        {{-- <thead style="background: #2f353a;">
            {!! Form::open(['route' => ['adminPanel.users.index'], 'method' => 'GET']) !!}

            <th>
                {!! Form::text('id', request()->filled('id')? old('id', request('id')) : null, ['class' => 'form-control', 'placeholder' => 'id']) !!}
            </th>
            <th>
                {!! Form::text('name', request()->filled('name')? old('name', request('name')) : null, ['class' => 'form-control', 'placeholder' => 'full name']) !!}
            </th>
            <th>
                {!! Form::email('email', request()->filled('email')? old('email', request('email')) : null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
            </th>
            <th>
                {!! Form::date('created_at', request()->filled('created_at')? old('created_at', request('created_at')) : null, ['class' => 'form-control', 'placeholder' => 'created_at']) !!}
            </th>
            <th>
                <div class='btn-group'>
                    {!! Form::button('<i class="fa fa-search"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-light', 'data-placement' => "top", 'data-html' => "true", 'data-original-title' => "All Ads in vape masr"]) !!}
                    <a href="{{route('adminPanel.users.index')}}" class="btn btn-ghost-light" , data-placement ="top" data-html = "true"data-original-title ="All Ads in vape masr"><i class="fa fa-ban"></i></a>
                </div>
            </th>

            {!! Form::close() !!}
        </thead> --}}
        <tbody>

        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->title .' '. $user->first_name .' '. $user->last_name }}</td>
            <td>{{ $user->country->name }}</td>
            <td>{{ $user->mobile }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at }}</td>
            <td>
                {!! Form::open(['route' => ['adminPanel.users.destroy', $user->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    @can('users view')
                    <a href="{{ route('adminPanel.users.show', [$user->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                    @endcan
                    @can('users destroy')
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    @endcan
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
