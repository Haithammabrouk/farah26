@extends('adminPanel.layouts.app')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">@lang('models/newsletters.plural')</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        @include('flash::message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>
                        @lang('models/newsletters.plural')
                        {{-- <a class="pull-right" href="{{ route('adminPanel.newsletters.create') }}"><i class="fa fa-plus-square fa-lg"></i></a> --}}
                    </div>
                    <div class="card-body">
                        @include('adminPanel.newsletters.table')
                     
                          <div class="d-flex justify-content-center mt-3">
                                {{ $newsletters->links('pagination::bootstrap-4') }}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection