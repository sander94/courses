@extends('layouts.admin')

@section('content')
<div class="content">
	<div class="row">
		<div class="col-12">

			<form>
				@csrf
				<textarea style="width: 400px; height: 300px;">Here we need WYSIWYG, with possibility to add images inside textbox. Image in public/images/screenshot.jpg
				</textarea><br>
				<button>Submit</button>
			</form>


</div>
</div>
</div>

@endsection