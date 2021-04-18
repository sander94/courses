@extends('layouts/web')

@section('content')

	<div class="row" style="padding-bottom: 300px; padding-top: 100px;">
		<div class="col-3">

		</div>

		<div class="col-6 text-center">

			<form action="{{ route('authenticate') }}" method="POST">
				@csrf
				<p>Username</p>
				<input type="text" name="email"><br>
				<p>Password</p>
				<input type="password" name="password"><br>
				<input type="submit" value="LOG IN" class="mt-5">
			</form>

		</div>

		<div class="col-3">

		</div>

	</div>



@endsection
