@extends ('layouts.master')
@section ('content')
<div class="container">
	<div class="row">
		<div class="col-4">
			<a class="btn btn-primary form-group d-none d-md-block" href="/">
				Return to Home Page
			</a>
			<a class="btn btn-primary form-group d-block d-md-none" href="/">
				Home
			</a>
		</div>
	</div>
	@if (!$results->count())
		<h1>No results found</h1>
	@endif

	<ul class="list-group">
		@foreach ($results as $result)
			<a class="list-group-item list-group-item-action" href="/{{$result->id }}">
				<strong>{{ $result->title }}</strong> <br>   
				{{substr($result->body, 0, 350)}}
				@if(strlen($result->body) > 350)
					{{"..."}}
				@endif
			</a>
		@endforeach
	</ul>
	<p>
	{{ $results->appends(request()->query())->links()}}
	</p>
</div>
@endsection
