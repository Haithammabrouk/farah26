@extends('adminPanel.layouts.app')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">@lang('models/sliderPhotos.plural')</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        @include('flash::message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>
                        @lang('models/sliderPhotos.plural')
                        <a class="pull-right" href="{{ route('adminPanel.sliderPhotos.create') }}"><i class="fa fa-plus-square fa-lg"></i></a>
                    </div>
                    <div class="card-body">
                        @include('adminPanel.slider_photos.table')
                      

                        
                                <div class="d-flex justify-content-center mt-3">
                                {{ $sliderPhotos->links('pagination::bootstrap-4') }}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
