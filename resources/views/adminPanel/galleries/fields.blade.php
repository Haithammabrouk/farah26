<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', __('models/galleries.fields.status').':') !!}
    <label class="radio-inline">
        {!! Form::radio('status', "1", "1") !!} Active
    </label>
    <label class="radio-inline">
        {!! Form::radio('status', "0", null) !!} Inactive
    </label>
</div>

<!-- Translated Field -->
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
                    {!! Form::label('name', __('models/galleries.fields.name').':') !!}
                    {!! Form::text($locale . '[name]', isset($gallery)? $gallery->translateOrNew($locale)->name : '' , ['class' => 'form-control', 'placeholder' => $name . ' name']) !!}
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
    <a href="{{ route('adminPanel.galleries.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
