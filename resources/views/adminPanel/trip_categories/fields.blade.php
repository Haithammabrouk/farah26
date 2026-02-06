<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('photo', __('models/tripCategories.fields.photo').':') !!}
    {!! Form::file('photo', null, ['class' => 'form-control']) !!}
    @if (isset($tripCategory))
    <img src="{{ asset($tripCategory->photo) }}" width="200">
    @endif
</div>
<!-- Map Photo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('map', __('models/tripCategories.fields.map').':') !!}
    {!! Form::file('map', null, ['class' => 'form-control']) !!}
    @if (isset($tripCategory))
    <img src="{{ asset($tripCategory->map) }}" width="200">
    @endif
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
                <!-- name Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('name', __('models/tripCategories.fields.name').':') !!}
                    {!! Form::text($locale . '[name]', isset($tripCategory)? $tripCategory->translateOrNew($locale)->name : '' , ['class' => 'form-control', 'placeholder' => $name . ' name']) !!}
                </div>

                <!-- duration Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('duration', __('models/tripCategories.fields.duration').':') !!}
                    {!! Form::text($locale . '[duration]', isset($tripCategory)? $tripCategory->translateOrNew($locale)->duration : '' , ['class' => 'form-control', 'placeholder' => $name . ' duration']) !!}
                </div>

                <!-- rate_plan Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('rate_plan', __('models/tripCategories.fields.rate_plan').':') !!}
                    {!! Form::textarea($locale . '[rate_plan]', isset($tripCategory)? $tripCategory->translateOrNew($locale)->rate_plan : '' , ['class' => 'form-control', 'placeholder' => $name . ' rate plan']) !!}
                </div>

                <!-- desc Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('desc', __('models/tripCategories.fields.desc').':') !!}
                    {!! Form::textarea($locale . '[desc]', isset($tripCategory)? $tripCategory->translateOrNew($locale)->desc : '' , ['class' => 'form-control', 'placeholder' => $name . ' desc']) !!}
                </div>
                <script type="text/javascript">
                    CKEDITOR.replace("{{ $locale . '[desc]' }}", {
                        filebrowserUploadUrl: "{{route('adminPanel.ckeditor.upload', ['_token' => csrf_token() ])}}"
                        , filebrowserUploadMethod: 'form'
                    });

                </script>
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
    <a href="{{ route('adminPanel.tripCategories.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
