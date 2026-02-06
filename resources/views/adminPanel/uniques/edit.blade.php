@extends('adminPanel.layouts.app')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{!! route('adminPanel.uniques.index') !!}">@lang('models/uniques.singular')</a>
    </li>
    <li class="breadcrumb-item active">@lang('crud.edit')</li>
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
@endif        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-edit fa-lg"></i>
                        <strong>Edit @lang('models/uniques.singular')</strong>
                    </div>
                    <div class="card-body">
                        {!! Form::model($unique, ['route' => ['adminPanel.uniques.update', $unique->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('adminPanel.uniques.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
