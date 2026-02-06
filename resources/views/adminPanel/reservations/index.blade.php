@extends('adminPanel.layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">@lang('models/reservations.plural')</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fa fa-align-justify"></i>
                             @lang('models/reservations.plural')
                             {{-- <a class="pull-right" href="{{ route('adminPanel.reservations.create') }}"><i class="fa fa-plus-square fa-lg"></i></a> --}}
                         </div>
                         <div class="card-body">
                             <!-- Search Form -->
                             <div class="row mb-3">
                                 <div class="col-md-6">
                                     <form method="GET" action="{{ route('adminPanel.reservations.index') }}" class="form-inline">
                                         <div class="input-group w-100">
                                             <input type="text"
                                                    name="search"
                                                    class="form-control"
                                                    placeholder="Search by name, email, mobile..."
                                                    value="{{ $search ?? '' }}">
                                             <div class="input-group-append">
                                                 <button class="btn btn-primary" type="submit">
                                                     <i class="fa fa-search"></i> Search
                                                 </button>
                                                 @if($search ?? false)
                                                 <a href="{{ route('adminPanel.reservations.index') }}" class="btn btn-secondary">
                                                     <i class="fa fa-times"></i> Clear
                                                 </a>
                                                 @endif
                                             </div>
                                         </div>
                                     </form>
                                 </div>
                             </div>

                             @include('adminPanel.reservations.table')

<div class="d-flex justify-content-center mt-3">
     {{ $reservations->appends(['search' => $search ?? ''])->links('pagination::bootstrap-4') }}
</div>
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection

