@extends('adminPanel.layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">@lang('models/roles.plural')</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fa fa-align-justify"></i>
                             @lang('models/roles.plural')
                             @can('roles create')
                                <a class="pull-right" href="{{ route('adminPanel.roles.create') }}"><i class="fa fa-plus-square fa-lg"></i></a>
                             @endcan
                         </div>
                         <div class="card-body">
                             @include('adminPanel.roles.table')
                        
                                   <div class="d-flex justify-content-center mt-3">
                                {{ $roles->links('pagination::bootstrap-4') }}
                            </div>
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection

