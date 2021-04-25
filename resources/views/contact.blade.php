@extends('layouts/web')

@section('content')

<div class="content">

	<h1 class="entry-title">Võta ühendust</h1>
	<div class="separator-orange"></div>

	<div class="row">
		<div class="col-8">
			<div class="mt-5">
				<p>Ka Company OÜ<br>
				Telefon: 56460814<br>
				E-mail: info@koolitused.ee<br><br>

				Reg. nr: 11491768<br>
				Juriidiline aadress: Mahla 82-78 Tallinn 11215<br>
				Pank: SEB EE301010220194512229</p>
			</div>

			<div class="mt-5">
				<p><span class="text-orange text-bold">Koolitused.ee</span> on Eesti suurim koolituste andmebaas, mis sisaldab üle 100 000 kursuse Eesti parimatelt koolitajatelt!<br>

				Lisaks suur valik ruume Eesti parimatelt pakkujatelt! <br>

				Olete koolitaja või pakute ruume koolitusteks, siis palun võtke meiega meilitsi ühendust info@koolitused.ee teeme Teile personaalse pakkumise Koolitused.ee andmebaasiga liitumiseks. </p>
			</div>
		</div>

		<div class="col-4">

			<form action="{{ route('contact') }}" method="POST" class="contactform">
				@csrf
				<input type="text" placeholder="Nimi" name="name" value="{{ old('name') }}">
                @if($errors->has('name'))
                    <span>{{ $errors->first('name') }}</span>
                @endif
				<input type="text" placeholder="E-mail või telefon" name="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <span>{{ $errors->first('email') }}</span>
                @endif
				<textarea type="text" placeholder="Sõnum..." name="text">{{ old('text') }}</textarea>
                @if($errors->has('text'))
                    <span>{{ $errors->first('text') }}</span>
                @endif
				<input type="submit" value="Saada">
			</form>

		</div>

	</div>

</div>

@endsection
