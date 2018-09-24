@extends ('layouts.master')
@section ('content')
<div class="container">
	<div class="row">
		<a class=" col-4 btn btn-primary form-group d-none d-sm-block" href="/">
		Return to Home Page
		</a>
		<a class=" col-4 btn btn-primary form-group d-block d-sm-none" href="/">
		Home
		</a>
		<h1 class="col-8 text-center">
			<strong>{{$id->title}}</strong>
		</h1>
	</div>
	
	<div class="row row-eq-height">
		<div class="col-md-6 text-justify">
			<p>
				<strong>Categories: </strong>
				@foreach ($id->categories as $category)
				{{ $category->name }}@if (! $loop->last),@endif
				@endforeach
			</p>
			<hr>

			@if($id->quarter)
				<p>
					<strong>Quarter: </strong>
					{{$id->quarter}}
				</p>
				<hr>
			@endif
			
			@if ($id->body)
				<p>{{ $id->body }}<br></p>
				<hr>
			@endif
		</div>

		<div class="col-md-6 text-justify">
			@if($id->hours['monday_hours'])
				<p>
					<strong>Opening Times:</strong> <br>
					Monday: {{$id->hours['monday_hours']}} <br>
					Tuesday: {{$id->hours['tuesday_hours']}} <br>
					Wednesday: {{$id->hours['wednesday_hours']}} <br>
					Thursday: {{$id->hours['thursday_hours']}} <br>
					Friday: {{$id->hours['friday_hours']}} <br>
					Saturday: {{$id->hours['saturday_hours']}} <br>
					Sunday: {{$id->hours['sunday_hours']}} <br>
					Bank Holidays: {{$id->hours['bank_hours']}}
				</p>
				<hr>
			@endif

			<p>
				<strong>Address:</strong><br>
				@foreach ($address as $line)
				{{ $line }} <br>
				@endforeach
			</p>
			<hr>
		
			@if ($id->phone)
				<p>
					<strong>Telephone:</strong> {{ $id->phone }}<br>
				</p>
			@endif
		</div>
	</div>

	<div class="row row-eq-height">
		<div class="col-md-6 text-justify">
			@if ($id->website)
			<hr>
			<!-- preg_replace to normalise different link formats -->
				<p>
					<strong>Visit Website:</strong>
					<a href="https://{{preg_replace('#^https?://#', '', $id->website)}}">
					{{ $id->website }}
					</a><br>
				</p>
			@endif
		</div>
		<div class="col-md-6 text-justify">
			<hr>
			@if ($id->instagram)
				<p>
					<strong>Instagram:</strong>
					<!-- preg_replace to normalise different link formats -->
					<a href="https://{{preg_replace('#^https?://#', '', $id->instagram) }}">
						{{ $id->instagram }}
					</a>
				</p>
			@endif
		
			@if ($id->twitter)
				<p>
					<strong>Twitter:</strong>
					<!-- preg_replace to normalise different link formats -->
					<a href="https://{{preg_replace('#^https?://#', '', $id->twitter) }}">
						{{ $id->twitter }}
					</a>
				</p>
			@endif

			@if ($id->youtube)
				<p>
					<strong>Youtube</strong>
					<!-- preg_replace to normalise different link formats -->
					<a href="https://{{preg_replace('#^https?://#', '', $id->youtube) }}">
						{{ $id->youtube }}
					</a>
				</p>
			@endif
		</div>
	</div>
		
	<div class="row">
		<div class="col-12">
			@if($id->latitude)	
				<hr>
					<div id="map"></div>
						<script>
							function initMap() {
  								var business = {lat: {{ $id->latitude }}, lng: {{ $id->longitude }} };
  								var map = new google.maps.Map(
      							document.getElementById('map'), {zoom: 16, center: business});
  								var marker = new google.maps.Marker({position: business, map: map});
							}
						</script>
					</div>
			@endif
		</div>
	</div>
</div>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZUjIXowIbVCPnbxjrbJrLIkVkhIfgxq4&callback=initMap">
</script>

@endsection