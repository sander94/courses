@extends('layouts.web')

@php
    /** @var \App\Services\BannerService $bannerService */
    $bannerService = app(\App\Services\BannerService::class);
    $banner = $bannerService->randomBanner(\App\Enums\AdTypeEnum::Rooms);
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

                    <input type="checkbox" class="hidden" id="teater"
                           {{ in_array('theatre_style_capacity',array_keys(request()->get('capacity', []))) ? 'checked' : null }} name="capacity[theatre_style_capacity]">
                    <div class="typebox teater">
                        <label for="teater">
                            <img src="{{ asset('images/teater.png') }}"><br>
                            Teater
                        </label>
                    </div>

                    <input type="checkbox" class="hidden" id="klass"
                           {{ in_array('classroom_style_capacity',array_keys(request()->get('capacity', [])))  ? 'checked' : null }} name="capacity[classroom_style_capacity]">
                    <div class="typebox klass">
                        <label for="klass">
                            <img src="{{ asset('images/klass.png') }}"><br>
                            Klass
                        </label>
                    </div>

                    <input type="checkbox" class="hidden" id="diplomaat"
                           {{ in_array('diplomatic_style_capacity',array_keys(request()->get('capacity', [])))  ? 'checked' : null }} name="capacity[diplomatic_style_capacity]">
                    <div class="typebox diplomaat">
                        <label for="diplomaat">
                            <img src="{{ asset('images/diplomaadistiil.png') }}"><br>
                            Diplomaat
                        </label>
                    </div>

                    <input type="checkbox" class="hidden" id="ushaped"
                           {{ in_array('u_shaped_capacity',array_keys(request()->get('capacity', [])))  ? 'checked' : null }} name="capacity[u_shaped_capacity]">
                    <div class="typebox ushaped">
                        <label for="ushaped">
                            <img src="{{ asset('images/u-kujuline.png') }}"><br>
                            U-kujuline
                        </label>
                    </div>

                    <input type="checkbox" class="hidden" id="vastuvott"
                           {{ in_array('inauguration_style_capacity',array_keys(request()->get('capacity', [])))  ? 'checked' : null }} name="capacity[inauguration_style_capacity]">
                    <div class="typebox vastuvott">
                        <label for="vastuvott">
                            <img src="{{ asset('images/vastuvott.png') }}"><br>
                            Vastuvõtt
                        </label>
                    </div>

                    <input type="checkbox" class="hidden"
                           {{ in_array('cabaret_style_capacity',array_keys(request()->get('capacity', [])))  ? 'checked' : null }} id="cabaret"
                           name="capacity[cabaret_style_capacity]">
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
                        @foreach($regions as $region)
                            <option
                                value="{{ $region->getKey() }}" {{ (string) $region->getKey() === request()->query('region') ? 'selected' : null }}>{{ $region->title }}</option>
                        @endforeach

                    </select>

                    <input type="submit" value="Filtreeri" class="findSubmit">


                </div>


                <div class="findServicesContainer" id="findServicesContainer">
                    <ul class="main">
                        @foreach($services as $service)
                            <li><label><input type="checkbox" name="services[]"
                                              value="{{ $service->id }}" {{ in_array($service->getKey(), request()->get('services')) ? 'checked' : null }}>{{ $service->title }}
                                </label>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </form>

        </div>


        <div class="row mt-5" style="text-align: left;">

            <div class="col-12">

                <!-- result element -->

                @foreach($properties as $property)
                    <div class="row mt-5">
                        <div class="col-3">
                            <div class="room-image"
                                 style="background-image: url('{{ $property->getFirstMediaUrl('cover') }}');">
                            </div>
                        </div>
                        <div class="col-9">
                            <h3>{{ $property->name }}</h3>
                            <p>Address: {{ $property->address }}<br>
                                Company name: {{ $property->company_name }}<br>
                                E-mail: {{ $property->email }}<br>
                                Services: {{ $property->services->implode('title',',') }} </p>
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
                                @foreach($property->rooms as $room)
                                    <tr style="height: 40px;">
                                        <td>{{ $room->name }}</td>
                                        <td class="text-center">{{ $room->square_meters }}</td>
                                        <td class="text-center"><i
                                                class="fa fa-user"></i> {{ $room->theatre_style_capacity ?? 0 }}</td>
                                        <td class="text-center"><i
                                                class="fa fa-user"></i> {{ $room->classroom_style_capacity ?? 0 }}</td>
                                        <td class="text-center"><i
                                                class="fa fa-user"></i> {{ $room->diplomatic_style_capacity ?? 0 }}</td>
                                        <td class="text-center"><i
                                                class="fa fa-user"></i> {{ $room->u_shaped_capacity ?? 0 }}</td>
                                        <td class="text-center"><i
                                                class="fa fa-user"></i> {{ $room->inauguration_style_capacity ?? 0 }}
                                        </td>
                                        <td class="text-center"><i
                                                class="fa fa-user"></i> {{ $room->cabaret_style_capacity ?? 0 }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
            @endforeach

            <!-- result element end -->


            </div>

        </div>


    </div>

    <script>

    </script>
@endsection
