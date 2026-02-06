<div class="table-responsive-sm">
    <table class="table table-striped " id="admins-table">
        <thead>
            <th>@lang('models/admins.fields.id')</th>
            <th>@lang('models/admins.fields.name')</th>
        <th>@lang('models/admins.fields.email')</th>
        <th>@lang('models/admins.fields.status')</th>
            <th colspan="3">@lang('crud.action')</th>
        </thead>
        <thead style="background: #2f353a;">
            {!! Form::open(['route' => ['adminPanel.admins.index'], 'method' => 'GET']) !!}

            <th>

            </th>
            <th>
                {!! Form::text('name', request()->filled('name')? old('name', request('name')) : null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
            </th>
            <th>
                {!! Form::email('email', request()->filled('email')? old('email', request('email')) : null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
            </th>
            <th>
                {!! Form::select('status', ['0' => 'Inactive', '1' => 'Active'], request()->filled('status')? old('status', request('status')) : null, ['class' => 'form-control', 'placeholder' => 'Status...']) !!}
            </th>
            <th>
                <div class='btn-group'>
                    {!! Form::button('<i class="fa fa-search"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-light', 'data-placement' => "top", 'data-html' => "true", 'data-original-title' => "All Ads in vape masr"]) !!}
                    <a href="{{route('adminPanel.admins.index')}}" class="btn btn-ghost-light" , data-placement ="top" data-html = "true"data-original-title ="All Ads in vape masr"><i class="fa fa-ban"></i></a>
                </div>
            </th>

            {!! Form::close() !!}
        </thead>
        <tbody>

        @foreach($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    {!! Form::open(['route' => ['adminPanel.admins.destroy', $admin->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminPanel.admins.show', [$admin->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        @can('admins edit')
                        <a href="{{ route('adminPanel.admins.edit', [$admin->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        @endcan

                        @can('admins destroy')
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
