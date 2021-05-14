@extends('layouts.web')

@php
    /** @var \App\Services\BannerService $bannerService */
    $bannerService = app(\App\Services\BannerService::class);
    $banner = $bannerService->randomBanner();
@endphp

@section('content')

    <div class="content">

        <div class="row">
            <div class="col-sm-4">
                <h1 class="text-3xl">Leia ürituste <br>tarbeks <br>sobilik <br>ruum</h1>
            </div>
            @if($banner)
                <div class="col-sm-8">
                    <a href="{{ route('ad', $banner) }}">
                        <img src="{{ $banner->getFirstMediaUrl('banner') }}" class="advert">
                    </a>
                </div>
            @endif
        </div>
        <style>
            .filter-container {
                display: flex;
                width: 100%;
                margin-top: 40px;
            }

            .filter {
                padding: 10px 20px;
                border: 2px solid #F66F4D;
                border-radius: 30px;
                margin-left: 10px;
                margin-right: 10px;
            }

            .findServices {
                width: 200px;
                height: 50px;
            }

            .findLocation {
                width: 200px;
                height: 50px;
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
                height: 50px;
            }

            .findServicesContainer {
                background-color: #FFFFFF;
                width: 100%;
                display: none;
                margin-top: 30px;
                padding: 40px 40px;
            }

            ul, li {
                list-style-type: none;
            }

            .typebox {
                width: 90px;
                text-align: center;
                border-radius: 8px;
                margin-right: 5px;
                box-sizing: border-box;
                border: 1px solid rgba(255, 255, 255, 0);
            }
            .room-image {
            	background-color: #dadada;
            	width: 280px;
            	height: 280px;
            }

            .typebox label {
                width: 100%;
                height: 100%;
                cursor: pointer;
                padding-top: 10px;
                box-sizing: border-box;
            }

            .typebox:hover {
                background-color: #FFFFFF;
                color: #F66F4D;
            }

            .hidden {
                display: none;
            }

            #teater:checked + .teater, #klass:checked + .klass, #diplomaat:checked + .diplomaat, #ushaped:checked + .ushaped, #vastuvott:checked + .vastuvott, #cabaret:checked + .cabaret {
                background-color: #FFFFFF;
                border: 1px solid #dadada;
                color: #F66F4D;
            }

            .roomstable {
                width: 100%;
            }
            .roomstable tr td {
                padding: 5px 10px;
            }
        </style>

        <div class="row">
        <form action="" method="GET">

            <div class="filter-container">

                <input type="checkbox" class="hidden" id="teater" name="theatre">
            	<div class="typebox teater">
            		<label for="teater">
	            		<img src="{{ asset('images/teater.png') }}"><br>
	            		Teater
            		</label>
				</div>

                <input type="checkbox" class="hidden" id="klass" name="classroom">
            	<div class="typebox klass">
            		<label for="klass">
	            		<img src="{{ asset('images/klass.png') }}"><br>
	            		Klass
	            	</label>
            	</div>

                <input type="checkbox" class="hidden" id="diplomaat" name="diplomat">
            	<div class="typebox diplomaat">
            		<label for="diplomaat">
	            		<img src="{{ asset('images/diplomaadistiil.png') }}"><br>
	            		Diplomaat
	            	</label>
            	</div>

                <input type="checkbox" class="hidden" id="ushaped" name="ushaped">
            	<div class="typebox ushaped">
            		<label for="ushaped">
	            		<img src="{{ asset('images/u-kujuline.png') }}"><br>
	            		U-kujuline
	            	</label>
            	</div>

                <input type="checkbox" class="hidden" id="vastuvott" name="vastuvott">
                <div class="typebox vastuvott">
                    <label for="vastuvott">
                        <img src="{{ asset('images/vastuvott.png') }}"><br>
                        Vastuvõtt
                    </label>
                </div>

                <input type="checkbox" class="hidden" id="cabaret" name="cabaret">
                <div class="typebox cabaret">
                    <label for="cabaret">
                        <img src="{{ asset('images/kabareestiil.png') }}"><br>
                        Kabaree
                    </label>
                </div>



                <span id="findCourse" class="filter findServices"
                      onclick="$('#findServicesContainer').slideToggle();">Pick services</span>

                <select id="findLocation" class="filter findLocation" name="region">
                    <option value="0">Region</option>
                </select>

                <input type="submit" value="Filtreeri" class="findSubmit">


            </div>


            <div class="findServicesContainer" id="findServicesContainer">
                <ul class="main">
                    @foreach($services as $service)
                	<li><label><input type="checkbox" value="{{ $service->id }}">{{ $service->title }}</label></li>
                    @endforeach
                </ul>

            </div>
        </form>

    </div>




    <div class="row mt-5" style="text-align: left;">

    	<div class="col-12">
    		
    		<!-- result element -->

    	   <div class="row mt-5">
                <div class="col-3">
                    <div class="room-image" style="background-image: url('');">image here</div>
                </div>
                <div class="col-9">
                    <h3>Property name</h2>
                    <p>Address: Property address<br>
                    Company name: Company name<br>
                    E-mail: <br>
                    Services: List of services here </p>
                    <table class="roomstable">
                        <tr style="background-color: #FFFFFF; height: 40px">
                            <td>Room name</td>
                            <td class="text-center">m2</td>
                            <td class="text-center"><img src="{{ asset('images/teater.png') }}"></td>
                            <td class="text-center"><img src="{{ asset('images/klass.png') }}"></td>
                            <td class="text-center"><img src="{{ asset('images/diplomaadistiil.png') }}"></td>
                            <td class="text-center"><img src="{{ asset('images/u-kujuline.png') }}"></td>
                            <td class="text-center"><img src="{{ asset('images/vastuvott.png') }}"></td>
                            <td class="text-center"><img src="{{ asset('images/kabareestiil.png') }}"></td>
                        </tr>
                        <tr style="height: 40px;">
                            <td>Room name 1</td>
                            <td class="text-center">200</td>
                            <td class="text-center"><i class="fa fa-user"></i> 100</td>
                            <td class="text-center"><i class="fa fa-user"></i> 40</td>
                            <td class="text-center"><i class="fa fa-user"></i> 30</td>
                            <td class="text-center"><i class="fa fa-user"></i> 80</td>
                            <td class="text-center"><i class="fa fa-user"></i> 70</td>
                            <td class="text-center"><i class="fa fa-user"></i> 80</td>
                        </tr>
                        <tr style="height: 40px;">
                            <td>Room name 2</td>
                            <td class="text-center">300</td>
                            <td class="text-center"><i class="fa fa-user"></i> 100</td>
                            <td class="text-center"><i class="fa fa-user"></i> 40</td>
                            <td class="text-center"><i class="fa fa-user"></i> 30</td>
                            <td class="text-center"><i class="fa fa-user"></i> 80</td>
                            <td class="text-center"><i class="fa fa-user"></i> 70</td>
                            <td class="text-center"><i class="fa fa-user"></i> 80</td>
                        </tr>
                        <tr style="height: 40px;">
                            <td>Room name 3</td>
                            <td class="text-center">300</td>
                            <td class="text-center"><i class="fa fa-user"></i> 100</td>
                            <td class="text-center"><i class="fa fa-user"></i> 40</td>
                            <td class="text-center"><i class="fa fa-user"></i> 30</td>
                            <td class="text-center"><i class="fa fa-user"></i> 80</td>
                            <td class="text-center"><i class="fa fa-user"></i> 70</td>
                            <td class="text-center"><i class="fa fa-user"></i> 80</td>
                        </tr>
                        <tr style="height: 40px;">
                            <td>Room name 4</td>
                            <td class="text-center">300</td>
                            <td class="text-center"><i class="fa fa-user"></i> 100</td>
                            <td class="text-center"><i class="fa fa-user"></i> 40</td>
                            <td class="text-center"><i class="fa fa-user"></i> 30</td>
                            <td class="text-center"><i class="fa fa-user"></i> 80</td>
                            <td class="text-center"><i class="fa fa-user"></i> 70</td>
                            <td class="text-center"><i class="fa fa-user"></i> 80</td>
                        </tr>
                    </table>
                </div>
            </div>  

            <!-- result element end -->


            <!-- result element -->

           <div class="row mt-5">
                <div class="col-3">
                    <div class="room-image" style="background-image: url('');">image here</div>
                </div>
                <div class="col-9">
                    <h3>Property name</h2>
                    <p>Address: Property address<br>
                    Company name: Company name<br>
                    E-mail: <br>
                    Services: List of services here </p>
                    <table class="roomstable">
                        <tr style="background-color: #FFFFFF; height: 40px">
                            <td>Room name</td>
                            <td class="text-center">m2</td>
                            <td class="text-center"><img src="{{ asset('images/teater.png') }}"></td>
                            <td class="text-center"><img src="{{ asset('images/klass.png') }}"></td>
                            <td class="text-center"><img src="{{ asset('images/diplomaadistiil.png') }}"></td>
                            <td class="text-center"><img src="{{ asset('images/u-kujuline.png') }}"></td>
                            <td class="text-center"><img src="{{ asset('images/vastuvott.png') }}"></td>
                            <td class="text-center"><img src="{{ asset('images/kabareestiil.png') }}"></td>
                        </tr>
                        <tr style="height: 40px;">
                            <td>Room name 1</td>
                            <td class="text-center">200</td>
                            <td class="text-center"><i class="fa fa-user"></i> 100</td>
                            <td class="text-center"><i class="fa fa-user"></i> 40</td>
                            <td class="text-center"><i class="fa fa-user"></i> 30</td>
                            <td class="text-center"><i class="fa fa-user"></i> 80</td>
                            <td class="text-center"><i class="fa fa-user"></i> 70</td>
                            <td class="text-center"><i class="fa fa-user"></i> 80</td>
                        </tr>
                        <tr style="height: 40px;">
                            <td>Room name 2</td>
                            <td class="text-center">300</td>
                            <td class="text-center"><i class="fa fa-user"></i> 100</td>
                            <td class="text-center"><i class="fa fa-user"></i> 40</td>
                            <td class="text-center"><i class="fa fa-user"></i> 30</td>
                            <td class="text-center"><i class="fa fa-user"></i> 80</td>
                            <td class="text-center"><i class="fa fa-user"></i> 70</td>
                            <td class="text-center"><i class="fa fa-user"></i> 80</td>
                        </tr>
                        <tr style="height: 40px;">
                            <td>Room name 3</td>
                            <td class="text-center">300</td>
                            <td class="text-center"><i class="fa fa-user"></i> 100</td>
                            <td class="text-center"><i class="fa fa-user"></i> 40</td>
                            <td class="text-center"><i class="fa fa-user"></i> 30</td>
                            <td class="text-center"><i class="fa fa-user"></i> 80</td>
                            <td class="text-center"><i class="fa fa-user"></i> 70</td>
                            <td class="text-center"><i class="fa fa-user"></i> 80</td>
                        </tr>
                        <tr style="height: 40px;">
                            <td>Room name 4</td>
                            <td class="text-center">300</td>
                            <td class="text-center"><i class="fa fa-user"></i> 100</td>
                            <td class="text-center"><i class="fa fa-user"></i> 40</td>
                            <td class="text-center"><i class="fa fa-user"></i> 30</td>
                            <td class="text-center"><i class="fa fa-user"></i> 80</td>
                            <td class="text-center"><i class="fa fa-user"></i> 70</td>
                            <td class="text-center"><i class="fa fa-user"></i> 80</td>
                        </tr>
                    </table>
                </div>
            </div>  

            <!-- result element end -->

    	</div>

    </div>


    </div>

    <script>

    </script>
@endsection
