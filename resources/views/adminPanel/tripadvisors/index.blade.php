@extends('adminPanel.layouts.app')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">@lang('models/tripadvisors.plural')</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        @include('flash::message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>
                        @lang('models/tripadvisors.plural')
                        <a class="pull-right" href="{{ route('adminPanel.tripadvisors.create') }}"><i class="fa fa-plus-square fa-lg"></i></a>
                    </div>
                    <div class="card-body">
                        @include('adminPanel.tripadvisors.table')
                       
                            <div class="d-flex justify-content-center mt-3">
                                {{ $tripadvisors->links('pagination::bootstrap-4') }}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
