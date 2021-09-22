@extends('layouts/web')

@section('content')

<div class="content">

	<h1 class="entry-title">Võta ühendust</h1>
	<div class="separator-orange"></div>

	<div class="row">
		<div class="col-12 col-sm-6 col-md-8">
			<div class="mt-5">
				<p>Ka Company OÜ<br>
				Telefon: 56460814<br>
				E-mail: info@koolitused.ee<br><br>

				Reg. nr: 11491768<br>
				Juriidiline aadress: Mahla 82-78 Tallinn 11215<br>
				Pank: SEB EE301010220194512229</p>
			</div>

			<div class="mt-5">
				<p><span class="text-orange text-bold">Koolitused.ee</span> on Eesti suurim koolituste andmebaas, mis sisaldab tuhandeid koolitusi Eesti parimatelt koolitajatelt!<br>

				Lisaks suur valik ruume Eesti parimatelt pakkujatelt! <br>

				Olete koolitaja või pakute ruume koolitusteks, siis palun võtke meiega meilitsi ühendust info@koolitused.ee teeme Teile personaalse pakkumise Koolitused.ee andmebaasiga liitumiseks. </p>
			</div>
		</div>

@if(false)
		<div class="col-12 col-sm-6 col-md-4">
			<span style="color: green; margin-bottom: 10px; font-weight: 600;">@if(Session::get('success')) {{ Session::get('success') }} @endif </span>
			<form action="{{ route('contact') }}" method="POST" class="contactform">
				@csrf
				<input type="text" placeholder="Nimi" name="name" value="{{ old('name') }}"                 @if($errors->has('name'))
                    style="border-color: red; background-color: #ffdbdb;"
                @endif>
				<input type="text" placeholder="E-mail või telefon" name="email" value="{{ old('email') }}" @if($errors->has('email'))
                    style="border-color: red; background-color: #ffdbdb;"
                @endif>
				<textarea type="text" placeholder="Sõnum..." name="text" @if($errors->has('text'))
                    style="border-color: red; background-color: #ffdbdb;"
                @endif>{{ old('text') }}</textarea>
				<input type="submit" value="Saada">
			</form>

		</div>
@endif

	</div>

</div>

@endsection
