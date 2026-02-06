<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/uniques.fields.id').':', ['style' => 'font-weight: bold;']) !!}
    <p>{{ $unique->id }}</p>
</div>
@foreach(config('langs') as $locale => $name)
<h3>
    <center>
        <code> {{$name}} </code>
    </center>
</h3>
<div class="form-group">
    {!! Form::label('title', __('models/uniques.fields.title').':', ['style' => 'font-weight: bold;']) !!}
    <p>{{ $unique->translateOrNew($locale)->title }}</p>
</div>

<div class="form-group">
    {!! Form::label('text', __('models/uniques.fields.text').':', ['style' => 'font-weight: bold;']) !!}
    <p>{{ $unique->translateOrNew($locale)->text }}</p>
</div>
@endforeach
<hr />
<!-- Photo Field -->
<div class="form-group">
    {!! Form::label('photo', __('models/uniques.fields.photo').':', ['style' => 'font-weight: bold;']) !!}
    <img src="{{$unique->photo}}" style="height: 150px; display: block" />
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/uniques.fields.created_at').':', ['style' => 'font-weight: bold;']) !!}
    <p>{{ $unique->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/uniques.fields.updated_at').':', ['style' => 'font-weight: bold;']) !!}
    <p>{{ $unique->updated_at }}</p>
</div>
