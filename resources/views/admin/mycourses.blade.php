@extends('layouts/web')

@section('content')

@include('partials.admin.submenu')

<div class="content">
<form action="" method="POST">
	<div class="row">
		<div class="col-12 mb-3">
			<input type="text" name="title" placeholder="Course title">
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<h2>Choose categories</h2>
			<span class="text-red">Is it possible to show all categories somehow in grid equally? We might have to think something with parent categories.. when you click on parent checkbox, it would check all children too.</span>
			<div><input type="checkbox">Category 1</div>
			<div><input type="checkbox">Category 2</div>
			<div><input type="checkbox">Category 3</div>
			<div><input type="checkbox">Category 4</div>
			<div><input type="checkbox">Category 5</div>
			<div><input type="checkbox">Category 6</div><br>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-12">
			Starts at: <input type="text" placeholder="datepicker here">
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-12">
			Ends at: <input type="text" placeholder="datepicker here">
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-12">
			Region: 
			<select name="region">
				<option>Harjumaa</option>
				<option>Pärnumaa</option>
				<option>Tartumaa</option>
			</select>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-12">
			Price: <input type="text" name="price">
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-12">
			Registration URL: <input type="text" name="URL">
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-12">
			Phone: <input type="text" name="phone">
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-12">
			E-mail: <input type="text" name="email" value="{{ Auth::user()->email }}">
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-12">
			<input type="submit" name="submit">
		</div>
	</div>

</form>

</div>




@endsection