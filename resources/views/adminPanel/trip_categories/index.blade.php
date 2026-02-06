@extends('adminPanel.layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">@lang('models/tripCategories.plural')</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fa fa-align-justify"></i>
                             @lang('models/tripCategories.plural')
                             <a class="pull-right" href="{{ route('adminPanel.tripCategories.create') }}"><i class="fa fa-plus-square fa-lg"></i></a>
                         </div>
                         <div class="card-body">
                             @include('adminPanel.trip_categories.table')
                           

                                <div class="d-flex justify-content-center mt-3">
                                {{ $tripCategories->links('pagination::bootstrap-4') }}
                            </div>
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection

