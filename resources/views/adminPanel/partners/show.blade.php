@extends('adminPanel.layouts.app')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('adminPanel.partners.index') }}">@lang('models/partners.singular')</a>
    </li>
    <li class="breadcrumb-item active">@lang('crud.detail')</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>{{ __('Whoops! Something went wrong.') }}</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>@lang('crud.detail')</strong>
                        <a href="{{ route('adminPanel.partners.index') }}" class="btn btn-ghost-light">Back</a>
                    </div>
                    <div class="card-body">
                        @include('adminPanel.partners.show_fields')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
