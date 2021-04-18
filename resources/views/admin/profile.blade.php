@extends('layouts.admin')

@section('content')
<form action="" method="post">
@csrf
<div class="content">
	<div class="row mt-5">
		<div class="col-4">
				<label>
					<p>Company name</p>
					<input type="text">
				</label>
		</div>
	</div>

	<div class="row">
		<div class="col-4">
				<label>
					<p>Phone</p>
					<input type="text">
				</label>
		</div>
	</div>

	<div class="row">
		<div class="col-4">
				<label>
					<p>Website</p>
					<input type="text">
				</label>
		</div>
	</div>

	<div class="row">
		<div class="col-4">
				<label>
					<p>E-mail address</p>
					<input type="text">
				</label>
		</div>
	</div>

	<div class="row">
		<div class="col-4">
				<label>
					<p>Reg no</p>
					<input type="text">
				</label>
		</div>
	</div>

	<div class="row">
		<div class="col-4">
				<label>
					<p>Brand name</p>
					<input type="text">
				</label>
		</div>
	</div>

	<div class="row">
		<div class="col-4">
				<label>
					<p>County (region)</p>
					<select>
						<option></option>
					</select>
				</label>
		</div>
	</div>

	<div class="row">
		<div class="col-4">
				<label>
					<p>City</p>
					<input type="text">
				</label>
		</div>
	</div>

	<div class="row">
		<div class="col-4">
				<label>
					<p>Street address</p>
					<input type="text">
				</label>
		</div>
	</div>

	<div class="row">
		<div class="col-4">
				<label>
					<p>Postal code</p>
					<input type="text">
				</label>
		</div>
	</div>

	<div class="row">
		<div class="col-4">
				<label>
					<p>Logo</p>
					<input type="file">
				</label>
		</div>
	</div>
</div>

</form>


@endsection