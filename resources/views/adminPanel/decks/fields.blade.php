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
                <!-- Title Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('title', __('models/decks.fields.title').':') !!}
                    {!! Form::text($locale . '[title]', isset($deck)? $deck->translateOrNew($locale)->title : '' , ['class' => 'form-control', 'placeholder' => $name . ' title']) !!}
                </div>
                <!-- Content Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('Content', __('models/decks.fields.content').':') !!}
                    {!! Form::textarea($locale . '[content]', isset($deck)? $deck->translateOrNew($locale)->content : '' , ['class' => 'form-control', 'placeholder' => $name . ' content']) !!}
                </div>
                <script type="text/javascript">
                    CKEDITOR.replace("{{ $locale . '[content]' }}", {
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
<!-- Photo 1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('file', __('models/decks.fields.file').':') !!}
    {!! Form::file('file') !!}
    @if (isset($deck))
    <img src="{{ asset($deck->file) }}" width="200">
    @endif
</div>

<!-- Photo 2 Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('other_file', __('models/decks.fields.other_file').':') !!}
    {!! Form::file('other_file') !!}
    @if (isset($deck))
    <img src="{{ asset($deck->other_file) }}" width="200">
@endif
</div>
<div class="clearfix"></div> --}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.decks.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
