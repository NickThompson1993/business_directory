@extends ('layouts.master')
@section ('content')
<div class="container">
	<div class="row height-10 align-items-center">
		<div class=col-12>
			<h2>Please enter your search parameters</h2>
		</div>
	</div>
	<form Method="GET" action="/search/">
		<div class="row height-10 align-items-center">
				<div class="col-md-4 form-group">
					<input class="form-control" type="text" name="title" placeholder="Company Title">
				</div>
				<div class="col-md-4 form-group">
					<select class="form-control" name="category">
						<option value="">Select Category</option>
						@foreach ($categories as $category)
							<option value="{{ $category->name }}">{{ $category->name }}</option>
						@endforeach
					</select>	
				</div>
				<div class="col-md-4 form-group">
					<select class="form-control" name="quarter">
						<option value="">Select Quarter</option>
						@foreach ($quarters as $quarter)
							<option value="{{ $quarter }}">{{ $quarter }}</option>
						@endforeach
					</select>
				</div>
			</div>
		<div class="row">
			<div class="col-12 d-flex justify-content-center items-align-center">
				<button type="submit" class="btn btn-primary bg-dark">Search</button>
			</div>
		</div>
	</form>
</div>

@endsection