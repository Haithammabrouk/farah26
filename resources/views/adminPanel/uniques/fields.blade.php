<ul class="nav nav-pills mb-1" id="pills-tab" role="tablist">
    @php $i = 1; @endphp
    @foreach ( config('langs') as $locale => $name)

    <li class="nav-item">
        <a class="nav-link {{$i?'active':''}}" id="{{$name}}-tab" data-toggle="pill" href="#{{$name}}" role="tab" aria-controls="{{$name}}" aria-selected="{{ $i ? 'true' : 'false'}}">{{$name}}</a>
    </li>

    @php $i = 0; @endphp
    @endforeach
</ul>
<br>
<div class="tab-content" id="pills-tabContent">
    <br>
    @php $i = 1; @endphp
    @foreach ( config('langs') as $locale => $name)
    <div class="tab-pane fade {{$i?'show active':''}}" id="{{$name}}" role="tabpanel" aria-labelledby="{{$name}}-tab" style="padding: 0;">
        <!-- Title Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('title', __('models/uniques.fields.title').':') !!}
            {!! Form::text($locale . '[title]', isset($unique) ? $unique->translateOrNew($locale)->title : "" , ['class' => 'form-control','minlength' => 3, 'placeholder' => $name . ' title']) !!}
        </div>
        <!-- Text Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('text', __('models/uniques.fields.text').':') !!}
            {!! Form::textarea($locale . '[text]', isset($unique) ? $unique->translateOrNew($locale)->text : "", ['class' => 'form-control','minlength' => 3, 'placeholder' => $name . ' text']) !!}
        </div>
    </div>
    @php $i = 0; @endphp
    @endforeach
</div>
<br />
<!-- Photo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('photo', __('models/uniques.fields.photo').':') !!}
    {!! Form::file('photo') !!}
    @if(isset($unique))
    <img src="{{$unique->photo}}" style="height: 70px; display: block;" />
    @endif
</div>
<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.uniques.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
