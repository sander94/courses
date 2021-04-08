@extends('layouts/web')

@section('content')

<div class="content">
	<h1 class="entry-title text-center">Artiklid</h1>
	<div class="separator-orange mx-auto"></div>

<div class="row blog-archive mt-5">

	<div class="col-4">

		<div class="blog-image-container" style="background-image: url('{{ asset('images/advert-ebs.png') }}');"></div>
		<a href="#" class="blog-title">10 lahedat ideed meeldejäävaks firmaürituseks</a>
		<p>On väga palju põhjuseid miks ettevõtte „kontorist väljas“ üritused on olulised. Need arendavad tiimitööd, loovad võimaluse mitteametlikus keskkonnas uusi suhteid luua, ergutavad väljakutsetele loovamalt lähenema ning on heaks lavaks kus tänada meeskonda eelmiste perioodide suurepärase töö eest.</p>

	</div>


</div>

	<div class="pagination">
		Shows 30 of 1214<br>
		1 2 3 4 5 6 7 ... 98
	</div>

</div>

@endsection