<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', __('models/additionalTrips.fields.price').':') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('SinglePrice', __('models/additionalTrips.fields.SinglePrice').':') !!}
    {!! Form::text('SinglePrice', null, ['class' => 'form-control']) !!}
</div>

<!-- Img Field -->
<div class="form-group col-sm-6">
    {!! Form::label('img', __('models/additionalTrips.fields.img').':') !!}
    {!! Form::file('img') !!}
    @if (isset($additionalTrip))
    <img src="{{ asset($additionalTrip->img) }}" width="200">
    @endif
</div>
<div class="clearfix"></div>

<div class="row">
    <div class="col nav-tabs-boxed">

        <ul class="nav nav-pills mb-1" id="pills-tab" role="tablist">
            @php $i = 1; @endphp
            @foreach ( config('langs') as $locale => $name)

            <li class="nav-item">
                <a class="nav-link {{$i?'active':''}}" id="{{$name}}-tab" data-toggle="pill" href="#{{$name}}" role="tab" aria-controls="{{$name}}" aria-selected="{{ $i ? 'true' : 'false'}}">{{$name}}</a>
            </li>

            @php $i = 0; @endphp
            @endforeach
        </ul>

        <div class="tab-content" id="pills-tabContent">
            @php $i = 1; @endphp
            @foreach ( config('langs') as $locale => $name)
            <div class="tab-pane fade {{$i?'show active':''}}" id="{{$name}}" role="tabpanel" aria-labelledby="{{$name}}-tab">
                <!-- name Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('name', __('models/additionalTrips.fields.name').':') !!}
                    {!! Form::text($locale . '[name]', isset($additionalTrip)? $additionalTrip->translateOrNew($locale)->name : '' , ['class' => 'form-control', 'placeholder' => $name . ' name']) !!}
                </div>

                <!-- location Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('location', __('models/additionalTrips.fields.location').':') !!}
                    {!! Form::text($locale . '[location]', isset($additionalTrip)? $additionalTrip->translateOrNew($locale)->location : '' , ['class' => 'form-control', 'placeholder' => $name . ' location']) !!}
                </div>

                <!-- details Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('details', __('models/additionalTrips.fields.details').':') !!}
                    {!! Form::textarea($locale . '[details]', isset($additionalTrip)? $additionalTrip->translateOrNew($locale)->details : '' , ['class' => 'form-control', 'placeholder' => $name . ' details']) !!}
                </div>
            </div>
            @php $i = 0; @endphp
            @endforeach
        </div>
    </div>
</div>

<br>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.additionalTrips.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
