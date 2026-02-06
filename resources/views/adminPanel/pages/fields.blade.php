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
                    {!! Form::label('title', __('models/pages.fields.name').':') !!}
                    {!! Form::text($locale . '[name]', isset($page)? $page->translateOrNew($locale)->name : '' , ['class' => 'form-control', 'placeholder' => $name . ' name']) !!}
                </div>
                          <!-- linke Field -->
                       <div class="form-group col-sm-6">
                           <label class="col-lg-4 col-form-label required fw-semibold fs-6">Video-Link:</label>
                           
                           
                          <input type="text" name="linke"
                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                        placeholder="Linke" value="{{ $page->linke ?? '' }}">
                        
            
                      </div>

                <!-- Content Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('Content', __('models/pages.fields.content').':') !!}
                    {!! Form::textarea($locale . '[content]', isset($page)? $page->translateOrNew($locale)->content : '' , ['class' => 'form-control', 'placeholder' => $name . ' content']) !!}
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

            <!-- Photo Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('photo', __('models/pages.fields.photo').':') !!}
                {!! Form::file('photo') !!}
                @if (isset($page->photo))
                @php
                $imageExtensions = ['jpg', 'jpeg', 'gif', 'png'];
                $explodeImage = explode('.', $page->photo);
                $extension = end($explodeImage);
                @endphp
                @if(in_array($extension, $imageExtensions))
                <img src="{{ asset($page->photo) }}" width="200" style="display: block;">
                @else
                <video width="200" style="display: block;" controls>
                    <source src="{{ asset($page->photo) }}" type="video/mp4" />
                </video>

                @endif
                @endif
            </div>
            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('adminPanel.pages.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
            </div>
        </div>
    </div>
</div>
