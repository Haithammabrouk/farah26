<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/additionalTrips.fields.id').':') !!}
    <p>{{ $additionalTrip->id }}</p>
</div>

@foreach(config('langs') as $locale => $name)

<h3>
    <center>
        <code> {{$name}} </code>
    </center>
</h3>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/additionalTrips.fields.name').':') !!}
    <p>{{ $additionalTrip->translateOrNew($locale)->name }}</p>
</div>

<!-- Location Field -->
<div class="form-group">
    {!! Form::label('location', __('models/additionalTrips.fields.location').':') !!}
    <p>{{ $additionalTrip->translateOrNew($locale)->location }}</p>
</div>
@endforeach

<hr />

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', __('models/additionalTrips.fields.price').':') !!}
    <p>{{ $additionalTrip->price }}</p>
</div>
<div class="form-group">
    {!! Form::label('SinglePrice', __('models/additionalTrips.fields.SinglePrice').':') !!}
    <p>{{ $additionalTrip->SinglePrice }}</p>
</div>

<!-- Img Field -->
<div class="form-group">
    {!! Form::label('img', __('models/additionalTrips.fields.img').':') !!}
    <p><img src="{{ asset($additionalTrip->img) }}" width="200"></p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/additionalTrips.fields.created_at').':') !!}
    <p>{{ $additionalTrip->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/additionalTrips.fields.updated_at').':') !!}
    <p>{{ $additionalTrip->updated_at }}</p>
</div>
