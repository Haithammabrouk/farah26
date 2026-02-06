<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/metas.fields.name').':') !!}
    {{-- {!! Form::text('name', null, ['class' => 'form-control']) !!} --}}
    @if (isset($meta))
    <h3>{{ $meta->name }}</h3>
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
                <!-- Title Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('title', __('models/metas.fields.title').':') !!}
                    {!! Form::text($locale . '[title]', isset($meta)? $meta->translateOrNew($locale)->title : '' , ['class' => 'form-control', 'placeholder' => $name . ' title']) !!}
                </div>

                <!-- Description Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('description', __('models/metas.fields.description').':') !!}
                    {!! Form::textarea($locale . '[description]', isset($meta)? $meta->translateOrNew($locale)->description : '' , ['class' => 'form-control', 'placeholder' => $name . ' description']) !!}
                </div>

                <!-- Keywords Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('keywords', __('models/metas.fields.keywords').':') !!}
                    {!! Form::textarea($locale . '[keywords]', isset($meta)? $meta->translateOrNew($locale)->keywords : '' , ['class' => 'form-control', 'placeholder' => $name . ' keywords']) !!}
                </div>
            </div>

            @php $i = 0; @endphp
            @endforeach


            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('adminPanel.metas.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
            </div>
        </div>
    </div>
</div>
