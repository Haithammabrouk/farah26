@extends('adminPanel.layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('adminPanel.countries.index') !!}">@lang('models/countries.singular')</a>
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
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-edit fa-lg"></i>
                            <strong>Edit @lang('models/countries.singular')</strong>
                        </div>
                        <div class="card-body">
                            {!! Form::model($coupon, ['route' => ['adminPanel.coupon.update', $coupon->id], 'method' => 'post']) !!}
                            <div class="row">
                                <div class="col nav-tabs-boxed">
                                    <div class="tab-content" id="pills-tabContent" style="padding: 30px;">

                                        <!-- name Field -->
                                        <div class="form-group col-sm-6">
                                            <div class="form-group col-sm-12">
                                                <label for="">coupon code</label>
                                                <input type="text" class="form-control" name="code"
                                                    value="{{ $coupon->coupon_code }}" placeholder="Enter coupon code">
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label for="">coupon duration</label>
                                                <input type="date" class="form-control" name="duration"
                                                    value="{{ $coupon->code_duration }}"
                                                    placeholder="Enter coupon duration">
                                            </div>
                                            <!-- Closed Cabin Field -->
                                            <div class="form-group col-sm-12">
                                                <label for="">Trips</label><br>
                                                @if ($coupon->related_trips->count() == $trips->count())
                                                    <input type="checkbox" id="music" name="all_trips" value="all_trips"
                                                        checked /><label style="margin-left: 10px;" for="music">all
                                                        trips</label>
                                                    <select name="trips[]" class="form-control select2" multiple="multiple">
                                                        @foreach ($trips as $additionalTrip)
                                                            <option value="{{ $additionalTrip->id }}"
                                                                {{ isset($tripsAdditionals) && in_array($additionalTrip->id, $tripsAdditionals) ? 'selected' : '' }}>
                                                                {{ $additionalTrip->id }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <input type="checkbox" id="music" name="all_trips"
                                                        value="all_trips" /><label style="margin-left: 10px;"
                                                        for="music">all
                                                        trips</label>

                                                    <select name="trips[]" class="form-control select2" multiple="multiple">
                                                        @foreach ($trips as $additionalTrip)
                                                            <option value="{{ $additionalTrip->id }}"
                                                                {{ isset($tripsAdditionals) && in_array($additionalTrip->id, $tripsAdditionals) ? 'selected' : '' }}>
                                                                {{ $additionalTrip->id }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif


                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label for="">discount</label>
                                                <input type="number" class="form-control" name="discount"
                                                    value="{{ $coupon->discount }}" placeholder="Enter discount">
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label for="">usage limit</label>
                                                <input type="number" class="form-control" name="limit"
                                                    value="{{ $coupon->usage_limit }}" placeholder="Enter usage limit">
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label for="">active</label>
                                                <select name="activation" class="form-control">
                                                    <option>Select Activation</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                            <!-- Submit Field -->
                                            <div class="form-group col-sm-12">
                                                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                                                <a href="{{ route('adminPanel.coupon') }}"
                                                    class="btn btn-default">@lang('crud.cancel')</a>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

</div>
