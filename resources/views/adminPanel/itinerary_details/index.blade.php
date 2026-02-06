@extends('adminPanel.layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">@lang('models/itineraryDetails.plural')</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fa fa-align-justify"></i>
                             @lang('models/itineraryDetails.plural')
                             <a class="pull-right" href="{{ route('adminPanel.itineraryDetails.create') }}"><i class="fa fa-plus-square fa-lg"></i></a>
                         </div>
                         <div class="card-body">
                             @include('adminPanel.itinerary_details.table')
                            
                                   <div class="d-flex justify-content-center mt-3">
                                {{ $itineraryDetails->links('pagination::bootstrap-4') }}
                            </div>
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection

