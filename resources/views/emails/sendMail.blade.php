<h1>{{ $data['message'] }}</h1>
@if (isset($data['link']))
	<a href={{ $data['link'] }}>click here</a>
@endif