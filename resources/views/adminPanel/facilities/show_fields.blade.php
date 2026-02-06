<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/facilities.fields.id').':', ['style' => 'font-weight: bold;']) !!}
    <p>{{ $facility->id }}</p>
</div>

<!-- Img Field -->
<div class="form-group">
    {!! Form::label('img', __('models/facilities.fields.img').':', ['style' => 'font-weight: bold;']) !!}
    <p><img src="{{ $facility->img }}" width="200"></p>
</div>

@foreach(config('langs') as $locale => $name)

<h3>
    <center>
        <code> {{$name}} </code>
    </center>
</h3>
<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/facilities.fields.name').':', ['style' => 'font-weight: bold;']) !!}
    <p>{{ $facility->translateOrNew($locale)->name }}</p>
</div>

<!-- Details Field -->
<div class="form-group">
    {!! Form::label('details', __('models/facilities.fields.details').':', ['style' => 'font-weight: bold;']) !!}
    <p>{{ $facility->translateOrNew($locale)->details }}</p>
</div>
@endforeach

<hr />

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/facilities.fields.created_at').':', ['style' => 'font-weight: bold;']) !!}
    <p>{{ $facility->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/facilities.fields.updated_at').':', ['style' => 'font-weight: bold;']) !!}
    <p>{{ $facility->updated_at }}</p>
</div>
