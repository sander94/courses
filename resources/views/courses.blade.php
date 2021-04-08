@extends('layouts/web')

@section('content')

<div class="content">
	<div class="row">
		<div class="col-4 pt-4">
			<h1 class="text-3xl">Eesti<br>suurim<br>koolituste<br>andmebaas</h1>
		</div>
		<div class="col-8">
			<a href="#">
				<img src="{{ asset('images/advert-ebs.png') }}" class="advert"> 
			</a>
		</div>
	</div>
<style>
	.filter-container {
		display: flex;
		width: 1000px;
		margin: 0 auto;
		margin-top: 40px;
		justify-content: center;
	}
	.filter {
		padding: 10px 20px;
		border: 2px solid #F66F4D;
		border-radius: 30px;
		margin-left: 10px;
		margin-right: 10px;
	}
	.findCourse {
		width: 300px;
	}
	.findLocation {
		width: 200px;
		background: transparent;
		-webkit-appearance: none;
	}
	.findDate {
		width: 150px;
	}
	.findDate {
		background: transparent;
	}
	.findSubmit {
		background-color: #F66F4D;
		border: 2px solid #F66F4D;
		border-radius: 30px;
		padding: 10px 30px;
		color: #FFFFFF;
		margin-left: 10px;
	}
	.findCourseContainer {
		background-color: #F66F4D;
		width: 100%;
		display: none;
		margin-top: 30px;
		padding: 50px;
	}
	ul, li {
		list-style-type: none;
	}

}
</style>
<form action="" method="GET">
<div class="filter-container">

	<span id="findCourse" class="filter findCourse" onclick="$('#findCourseContainer').slideToggle();">Choose category</span>


	<select id="findLocation" class="filter findLocation" name="location">
		<option value="">Location</option>
		<option>Pärnu</option>
		<option>Tartu</option>
		<option>Tallinn</option>
		<option>Maakond/linn</option>
		<option>Maakond/linn</option>
		<option>Maakond/linn</option>
		<option>Maakond/linn</option>
		<option>Maakond/linn</option>
		<option>Maakond/linn</option>
	</select>
	<input type="text" id="datepicker" class="filter findDate" name="start_date" placeholder="Start date">
	<input type="submit" value="Filtreeri" class="findSubmit">


</div>


<div class="findCourseContainer" id="findCourseContainer">
	<ul class="main">
		<li><label><input type="radio" name="category" value="Category one">Category one</label></li>
		<li><label><input type="radio" name="category" value="Category two">Category two</label>
			<ul class="sub">
				<li><label><input type="radio" name="category">Subcategory one</label></li>
				<li><label><input type="radio" name="category">Subcategory two</label></li>
				<li><label><input type="radio" name="category">Subcategory three</label></li>
			</ul>
		</li>
		<li><label><input type="radio" name="category">Category three</label></li>
		<li><label><input type="radio" name="category">Category four</label></li>
		<li><label><input type="radio" name="category">Category five</label></li>
		<li><label><input type="radio" name="category">Category six</label>
			<ul class="sub">
				<li><label><input type="radio" name="category">Subcategory one</label></li>
				<li><label><input type="radio" name="category">Subcategory two</label></li>
				<li><label><input type="radio" name="category">Subcategory three</label></li>
			</ul>
		</li>
	</ul>

</div>
</form>
<div class="results-table-container">

	<table border="0" cellpadding="0" cellspacing="0" class="results-table">
		<tr class="tableheader">
			<td style="width: 150px;">Kuupäev</td>
			<td style="width: 100px;">Kestus</td>
			<td style="width: 200px;">Koolitaja</td>
			<td>Koolitus</td>
			<td style="width: 100px;">Hind</td>
			<td style="width: 100px;">Koht</td>
			<td style="width: 120px;">&nbsp;</td>
		</tr>
		<tr>
			<td style="font-weight: 300;">23.03 - 20.04<br>20 days</td>
			<td style="font-weight: 300;">15 hours</td>
			<td style="font-weight: 300;">NORT koolitus (company name)</td>
			<td>Course name... Veebilehe ja E-poe loomine ning haldamine - komplekskoolitus TALLINN või VEEBIKOOLITUS</td>
			<td style="font-weight: 300;">650 €</td>
			<td style="font-weight: 300;">Tallinn</td>
			<td><a href="#readmore" class="table-readmore">Loe lisa</a></td>
		</tr>


		<tr>
			<td style="font-weight: 300;">23.03 - 20.04<br>20 days</td>
			<td style="font-weight: 300;">15 hours</td>
			<td style="font-weight: 300;">NORT koolitus (company name)</td>
			<td>Course name... Veebilehe ja E-poe loomine ning haldamine - komplekskoolitus TALLINN või VEEBIKOOLITUS</td>
			<td style="font-weight: 300;">650 €</td>
			<td style="font-weight: 300;">Tallinn</td>
			<td><a href="#readmore" class="table-readmore">Loe lisa</a></td>
		</tr>



		<tr>
			<td style="font-weight: 300;">23.03 - 20.04<br>20 days</td>
			<td style="font-weight: 300;">15 hours</td>
			<td style="font-weight: 300;">NORT koolitus (company name)</td>
			<td>Course name... Veebilehe ja E-poe loomine ning haldamine - komplekskoolitus TALLINN või VEEBIKOOLITUS</td>
			<td style="font-weight: 300;">650 €</td>
			<td style="font-weight: 300;">Tallinn</td>
			<td><a href="#readmore" class="table-readmore">Loe lisa</a></td>
		</tr>



		<tr>
			<td style="font-weight: 300;">23.03 - 20.04<br>20 days</td>
			<td style="font-weight: 300;">15 hours</td>
			<td style="font-weight: 300;">NORT koolitus (company name)</td>
			<td>Course name... Veebilehe ja E-poe loomine ning haldamine - komplekskoolitus TALLINN või VEEBIKOOLITUS</td>
			<td style="font-weight: 300;">650 €</td>
			<td style="font-weight: 300;">Tallinn</td>
			<td><a href="#readmore" class="table-readmore">Loe lisa</a></td>
		</tr>



		<tr>
			<td style="font-weight: 300;">23.03 - 20.04<br>20 days</td>
			<td style="font-weight: 300;">15 hours</td>
			<td style="font-weight: 300;">NORT koolitus (company name)</td>
			<td>Course name... Veebilehe ja E-poe loomine ning haldamine - komplekskoolitus TALLINN või VEEBIKOOLITUS</td>
			<td style="font-weight: 300;">650 €</td>
			<td style="font-weight: 300;">Tallinn</td>
			<td><a href="#readmore" class="table-readmore">Loe lisa</a></td>
		</tr>


	</table>

	<div class="pagination">
		Shows 30 of 1214<br>
		1 2 3 4 5 6 7 ... 98
	</div>

</div>

</div>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>

  <script>
  	$('ul li').click(function() {
  		$('#findCourseContainer').slideUp();
  	});
  </script>
@endsection