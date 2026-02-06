<!-- Img Field -->
<div class="form-group col-sm-6">
    {!! Form::label('img', __('models/facilities.fields.img').':') !!}
    {!! Form::file('img') !!}
    @if (isset($facility))
    <img src="{{ asset($facility->img) }}" width="200">
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
                    {!! Form::label('name', __('models/facilities.fields.name').':') !!}
                    {!! Form::text($locale . '[name]', isset($facility)? $facility->translateOrNew($locale)->name : '' , ['class' => 'form-control', 'placeholder' => $name . ' name']) !!}
                </div>

                <!-- details Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('details', __('models/facilities.fields.details').':') !!}
                    {!! Form::textarea($locale . '[details]', isset($facility)? $facility->translateOrNew($locale)->details : '' , ['class' => 'form-control', 'placeholder' => $name . ' details']) !!}
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
    <a href="{{ route('adminPanel.facilities.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
