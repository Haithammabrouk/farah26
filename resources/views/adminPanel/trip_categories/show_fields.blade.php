<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/tripCategories.fields.id').':') !!}
    <p>{{ $tripCategory->id }}</p>
</div>

@foreach(config('langs') as $locale => $name)
<h3>
    <center>
        <code> {{$name}} </code>
    </center>
</h3>
<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/tripCategories.fields.name').':') !!}
    <p>{{ $tripCategory->translateOrNew($locale)->name }}</p>
</div>

<!-- Duration Field -->
<div class="form-group">
    {!! Form::label('duration', __('models/tripCategories.fields.duration').':') !!}
    <p>{{ $tripCategory->translateOrNew($locale)->duration }}</p>
</div>

<!-- Desc Field -->
<div class="form-group">
    {{ Form::label('desc', __('models/tripCategories.fields.desc').':') }}
    <p>{!! $tripCategory->translateOrNew($locale)->desc !!}</p>
</div>

<!-- Rate Plan Field -->
<div class="form-group">
    {!! Form::label('rate_plan', __('models/tripCategories.fields.rate_plan').':') !!}
    <p>{{ $tripCategory->translateOrNew($locale)->rate_plan }}</p>
</div>

@endforeach

<hr style="text-weight: bold;" />
<!-- Photo Field -->
<div class="form-group">
    {!! Form::label('photo', __('models/tripCategories.fields.photo').':') !!}
    <p><img src="{{ asset($tripCategory->photo) }}" width="200"></p>
</div>

<!-- Map Photo Field -->
<div class="form-group">
    {!! Form::label('map', __('models/tripCategories.fields.map').':') !!}
    <p><img src="{{ asset($tripCategory->map) }}" width="200"></p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/tripCategories.fields.created_at').':') !!}
    <p>{{ $tripCategory->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/tripCategories.fields.updated_at').':') !!}
    <p>{{ $tripCategory->updated_at }}</p>
</div>
