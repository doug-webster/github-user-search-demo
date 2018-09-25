@extends('layouts.master')

@section('content')
<h3>GitHub User Search</h3>

{{csrf_field()}}

<div class="form-group">
	<label for="i-username">Search for: </label>
	<input type="search" name="username" id="i-username" class="form-control" />
</div>
<div class="form-group">
	<button type="button" class="btn btn-default" id="search-github-users">Search</button>
</div>

<div id="results"></div>

@endsection
