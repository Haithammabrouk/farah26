<!-- Itinerary Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('itinerary_id', __('models/itineraryDetails.fields.itinerary_id').':') !!}
    <select name="itinerary_id" class="form-control">
        <option value="">select</option>
        @foreach ($itineraries as $itinerary)
        <option value="{{ $itinerary->id }}" {{ isset($itineraryDetail) && $itineraryDetail->itinerary_id == $itinerary->id ? 'selected' : '' }}>
            {{ $itinerary->tripCategory->name .' - Day '. $itinerary->day }}
        </option>
        @endforeach
    </select>
</div>

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
                <!-- text Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('text', __('models/itineraryDetails.fields.text').':') !!}
                    {!! Form::text($locale . '[text]', isset($itineraryDetail)? $itineraryDetail->translateOrNew($locale)->text : '' , ['class' => 'form-control', 'placeholder' => $name . ' text']) !!}
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
    <a href="{{ route('adminPanel.itineraryDetails.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
