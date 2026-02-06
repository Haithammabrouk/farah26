@component('mail::message')
Hello {{ $reservation->user->title .' '. $reservation->user->first_name .' '. $reservation->user->last_name }}

Thank you for choosing FarahNileCruise.com for your Cruise. Please present this voucher upon arrival at your destination.


# Booking Order # {{ $reservation->uuid }}


<span style="border-bottom: 1px solid #9A9A9A">Trip Information</span>
<div>{{ $reservation->trip->tripCategory->name }}</div>
<div>Arrival Date : {{ $reservation->trip->check_in }}</div>
<div>Departure Date : {{ $reservation->trip->check_out }}</div>

<br>

<span style="border-bottom: 1px solid #9A9A9A">Customer Details</span>
<div>
	Name : {{ $reservation->user->title .' '. $reservation->user->first_name .' '. $reservation->user->last_name }}
</div>
<div>Country : {{ $reservation->user->country->name }}</div>
<div>Phone : {{ $reservation->user->mobile }}</div>
<div>Email : {{ $reservation->user->email }}</div>

<br>

<span style="border-bottom: 1px solid #9A9A9A">Booking Information</span>
<div>Booking Ref. No : # {{ $reservation->uuid }}</div>
<div>Booking Date : {{ $reservation->created_at }}</div>


<div>No of Cabins : {{ $reservation->accommodations->count() }}</div>
<div>No. of Adults : {{ $reservation->accommodations->sum('adults_count') }}</div>
<div>No. of Children : {{ $reservation->accommodations->sum('children_count') }}</div>

<br>

<span style="border-bottom: 1px solid #9A9A9A">Cabin Types</span>
@php
	$accommodationTotal = 0;
@endphp

@foreach ($reservation->accommodations as $accommodation)
<p>
	Cabin Type : {{ $accommodation->type == 1 ? 'Cabin' : 'Suite' }} || Cabin No. : {{ $accommodation->accommodation_num }} || Guest Name : {{ $accommodation->guest_name }} || Cabin Rate : {{ $accommodation->type == 1 ? $accommodation->cabin_price : $accommodation->suite_price }} USD ||
</p>

<p>Discount {{ $accommodation->discount }} %</p>


<p>Subtotal {{ $accommodation->total_price }} USD</p>

@php
	$accommodationTotal += $accommodation->total_price;
@endphp
@endforeach

<br>

<p>Rooms Total Amount : {{ $accommodationTotal }} USD</p>

<br>

<span style="border-bottom: 1px solid #9A9A9A">Additional Trips</span>

@php
	$reservedTripTotal = 0;
@endphp

@foreach ($reservation->reservedAdditionalTrips as $reservedTrip)
<p>
	Trip Name : {{ $reservedTrip->additionalTrip->name }} || No. of Adults : {{ $reservedTrip->adults_count }} || No. of Children : {{ $reservedTrip->child1_count + $reservedTrip->child1_count }} || Trip Rate : {{ $reservedTrip->price }} USD ||
</p>
<p>Subtotal {{ $reservedTrip->total_price }} USD</p>
@php
	$reservedTripTotal += $reservedTrip->total_price;
@endphp
@endforeach

<br>

<p>Additional Trips Total Amount : {{ $reservedTripTotal }} USD</p>

<p>Total Booking Amount {{ $reservation->price }} USD</p>

<p>All rates are for the TOTAL STAY and include VAT.</p>

<p>Terms and Conditions for FarahNileCruise.com</p>
@component('mail::button', ['url' => 'https://farahnilecruise.com/terms'])
Terms And Conditions
@endcomponent

<hr>
<!--<p>In case of the boat not sailing, after advising the Second party in written two weeks before the check in, the First Party has the responsibility to turn a way these cabins on the same category ship during the period.</p>-->


Thanks,<br>
{{ config('app.name') }}
@endcomponent
