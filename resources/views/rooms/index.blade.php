@extends('layouts.web')



@section('content')

    <div class="content">
        <div class="row">
            <div class="col-4 pt-4">
                <h1 class="text-3xl">Leia ürituse<br>tarbeks<br>sobilik<br>ruum</h1>
            </div>
            @if(false)
                <div class="col-8">
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
                background-color: #F66F4D;
                width: 100%;
                display: none;
                margin-top: 30px;
                padding: 50px;
            }

            ul, li {
                list-style-type: none;
            }

            .typebox {
            	margin-right: 20px;
            }
            .room-image {
            	background-color: #dadada;
            	width: 200px;
            	height: 200px;
            }

            
        </style>

        <div class="row">
        <form action="" method="GET">
            <div class="filter-container">

            	<div class="typebox">
            		<label>
	            		<img src="{{ asset('images/diplomatic.png') }}"><br>
	            		<input type="checkbox">Diplomatic
            		</label>
				</div>

            	<div class="typebox">
            		<label>
	            		<img src="{{ asset('images/diplomatic.png') }}"><br>
	            		<input type="checkbox">Classroom
	            	</label>
            	</div>

            	<div class="typebox">
            		<label>
	            		<img src="{{ asset('images/diplomatic.png') }}"><br>
	            		<input type="checkbox">Theatre
	            	</label>
            	</div>

            	<div class="typebox">
            		<label>
	            		<img src="{{ asset('images/diplomatic.png') }}"><br>
	            		<input type="checkbox">U-shaped
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

                	<input type="checkbox" value="service1">Coffee<br>
                	<input type="checkbox" value="service1">Free parking<br>
                	<input type="checkbox" value="service1">Accommodation<br>
                	<input type="checkbox" value="service1">Projector<br>
                	<input type="checkbox" value="service1">Sound system<br>
                	<input type="checkbox" value="service1">TV and video<br>

                </ul>

            </div>
        </form>

    </div>


<br><br><br>
    <div class="row">


    	Results


    </div>

    <div class="row" style="text-align: left;">

    	<div class="col-12">
    		


    		<!-- result element -->

    		<div class="row">
    			<div class="col-3">
    				<div class="room-image" style="background-image: url('');"></div>
    			</div>
    			<div class="col-9">
    				<h3>Property name</h2>
    				<p>Address: <br>
    				E-mail: <br>
    				Services: List of services here </p>
    				<table style="width: 100%; left: 0;">
    					<tr style="background-color: #dadada;">
    						<td>Room</td>
    						<td>m2</td>
    						<td><img src="{{ asset('images/diplomatic.png') }}"></td>
    						<td><img src="{{ asset('images/diplomatic.png') }}"></td>
    						<td><img src="{{ asset('images/diplomatic.png') }}"></td>
    						<td><img src="{{ asset('images/diplomatic.png') }}"></td>
    						<td><img src="{{ asset('images/diplomatic.png') }}"></td>
    						<td><img src="{{ asset('images/diplomatic.png') }}"></td>
    					</tr>
    					<tr style="height: 40px;">
    						<td>Room name 1</td>
    						<td>200 m2</td>
    						<td>100 people</td>
    						<td>40 people</td>
    						<td>30 people</td>
    						<td>80 people</td>
    						<td>70 people</td>
    						<td>80 people</td>
    					</tr>
    					<tr style="height: 40px;">
    						<td>Room name 2</td>
    						<td>200 m2</td>
    						<td>100 people</td>
    						<td>40 people</td>
    						<td>30 people</td>
    						<td>80 people</td>
    						<td>70 people</td>
    						<td>80 people</td>
    					</tr>
    				</table>
    			</div>
    		</div>

    		<!-- result element end -->












    	</div>

    </div>


    </div>

    <script>
        $('ul li').click(function () {
            $('#findServicesContainer').slideUp();
        });
    </script>
@endsection
