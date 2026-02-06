<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/itineraryDetails.fields.id').':', ['style' => 'font-weight: bold;']) !!}
    <p>{{ $itineraryDetail->id }}</p>
</div>


@foreach(config('langs') as $locale => $name)
<h3>
    <center>
        <code> {{$name}} </code>
    </center>
</h3>
<!-- Itinerary Id Field -->
<div class="form-group">
    {!! Form::label('itinerary_id', __('models/itineraryDetails.fields.itinerary_id').':', ['style' => 'font-weight: bold;']) !!}
    <p>{{ $itineraryDetail->itinerary->tripCategory->translateOrNew($locale)->name }} - Day {{$itineraryDetail->itinerary->day}}</p>
</div>
<!-- Text Field -->
<div class="form-group">
    {!! Form::label('text', __('models/itineraryDetails.fields.text').':', ['style' => 'font-weight: bold;']) !!}
    <p>{{ $itineraryDetail->translateOrNew($locale)->text }}</p>
</div>
@endforeach
<hr />
<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/itineraryDetails.fields.created_at').':', ['style' => 'font-weight: bold;']) !!}
    <p>{{ $itineraryDetail->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/itineraryDetails.fields.updated_at').':', ['style' => 'font-weight: bold;']) !!}
    <p>{{ $itineraryDetail->updated_at }}</p>
</div>
