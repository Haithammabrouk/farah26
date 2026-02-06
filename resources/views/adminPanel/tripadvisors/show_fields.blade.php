<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/tripadvisors.fields.id').':', ['style' => 'font-weight: bold;']) !!}
    <p>{{ $tripadvisor->id }}</p>
</div>

@foreach(config('langs') as $locale => $name)
<h3>
    <center>
        <code> {{$name}} </code>
    </center>
</h3>
<div class="form-group">
    {!! Form::label('title', __('models/tripadvisors.fields.title').':', ['style' => 'font-weight: bold;']) !!}
    <p>{{ $tripadvisor->translateOrNew($locale)->title }}</p>
</div>

<div class="form-group">
    {!! Form::label('text', __('models/tripadvisors.fields.text').':', ['style' => 'font-weight: bold;']) !!}
    <p>{{ $tripadvisor->translateOrNew($locale)->text }}</p>
</div>
@endforeach
<hr />
<!-- Author Field -->
<div class="form-group">
    {!! Form::label('author', __('models/tripadvisors.fields.author').':', ['style' => 'font-weight: bold;']) !!}
    <p>{{ $tripadvisor->author }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/tripadvisors.fields.created_at').':', ['style' => 'font-weight: bold;']) !!}
    <p>{{ $tripadvisor->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/tripadvisors.fields.updated_at').':', ['style' => 'font-weight: bold;']) !!}
    <p>{{ $tripadvisor->updated_at }}</p>
</div>
