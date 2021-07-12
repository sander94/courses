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
            .galleryboxImg {
                height: 50px;
                width:  100%;
                cursor: pointer;
            }
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
                cursor: pointer;
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
                background-color: #FFFFFF;
                width: 280px;
                height: 280px;
                background-size: 90%;
                background-repeat: no-repeat;
                background-position: center center;
            }

            .smallgallery {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                column-gap: 5px;
                row-gap: 5px;
            }

            @media screen and (max-width: 1250px) {
                .room-image {
                    width: 100%;
                    height:  150px;
                }
                .small-gallery {
                    grid-template-columns: repeat(6, minmax(0, 1fr));
                }
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
            .main li label {
                cursor: pointer;
            }
            .main li:hover {
                color:  #F66F4D;
            }
        </style>

        <div class="row">
            <form action="" method="GET">

                <div class="filter-container">

                    <input type="checkbox" class="hidden" id="teater"
                           {{ in_array('theatre_style_capacity',array_keys(request()->get('capacity', [])) ?? []) ? 'checked' : null }} name="capacity[theatre_style_capacity]">
                    <div class="typebox teater">
                        <label for="teater">
                            <img src="{{ asset('images/teater.png') }}"><br>
                            Teater
                        </label>
                    </div>

                    <input type="checkbox" class="hidden" id="klass"
                           {{ in_array('classroom_style_capacity',array_keys(request()->get('capacity', [])) ?? [])  ? 'checked' : null }} name="capacity[classroom_style_capacity]">
                    <div class="typebox klass">
                        <label for="klass">
                            <img src="{{ asset('images/klass.png') }}"><br>
                            Klass
                        </label>
                    </div>

                    <input type="checkbox" class="hidden" id="diplomaat"
                           {{ in_array('diplomatic_style_capacity',array_keys(request()->get('capacity', [])) ?? [])  ? 'checked' : null }} name="capacity[diplomatic_style_capacity]">
                    <div class="typebox diplomaat">
                        <label for="diplomaat">
                            <img src="{{ asset('images/diplomaadistiil.png') }}"><br>
                            Diplomaat
                        </label>
                    </div>

                    <input type="checkbox" class="hidden" id="ushaped"
                           {{ in_array('u_shaped_capacity',array_keys(request()->get('capacity', [])) ?? [])  ? 'checked' : null }} name="capacity[u_shaped_capacity]">
                    <div class="typebox ushaped">
                        <label for="ushaped">
                            <img src="{{ asset('images/u-kujuline.png') }}"><br>
                            U-kujuline
                        </label>
                    </div>

                    <input type="checkbox" class="hidden" id="vastuvott"
                           {{ in_array('inauguration_style_capacity',array_keys(request()->get('capacity', [])) ?? [])  ? 'checked' : null }} name="capacity[inauguration_style_capacity]">
                    <div class="typebox vastuvott">
                        <label for="vastuvott">
                            <img src="{{ asset('images/vastuvott.png') }}"><br>
                            Vastuvõtt
                        </label>
                    </div>

                    <input type="checkbox" class="hidden"
                           {{ in_array('cabaret_style_capacity',array_keys(request()->get('capacity', [])) ?? [])  ? 'checked' : null }} id="cabaret"
                           name="capacity[cabaret_style_capacity]">
                    <div class="typebox cabaret">
                        <label for="cabaret">
                            <img src="{{ asset('images/kabareestiil.png') }}"><br>
                            Kabaree
                        </label>
                    </div>


                    <span id="findCourse" class="filter findServices"
                          onclick="$('#findServicesContainer').slideToggle();">Lisateenused</span>

                    <select id="findLocation" class="filter findLocation" name="region">
                        <option value="0">Piirkond</option>
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
                                              value="{{ $service->id }}" {{ in_array($service->getKey(), request()->get('services', [])) ? 'checked' : null }}>{{ $service->title }}
                                </label>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </form>

        </div>


        <div class="row mt-5" id="list" style="text-align: left;">

            <div class="col-12">

                <!-- result element -->

                @foreach($properties as $property)

                    @php
                        $servicearray = $property->services->implode('title',',');
                        $servicearray = strtolower($servicearray);
                        $servicearray = str_replace(',', ', ', $servicearray);
                    @endphp

                    <div class="row mt-5">
                        <div class="col-12 col-md-3">
                            <div class="room-image"
                                 style="background-image: url('{{ $property->getFirstMediaUrl('cover') }}');">
                            </div>

                            @php
                                $media = $property->getMedia('gallery');
                                $urls = $media->map->getUrl();
                                $thumbUrls = $media->map->getUrl('galleryThumb');
                            @endphp

                            <div class="smallgallery">
                            @foreach($thumbUrls as $index => $url)
                                <img @click="showImg({{ json_encode($urls) }}, {!! $index !!})" class="galleryboxImg" src="{{ $url }}">
                            @endforeach
                            </div>
                        </div>
                        <div class="col-12 col-md-9">
                            <h3 class="text-orange">{{ $property->name }}</h3>
                            <p><i class="fa fa-home fa-fw"> </i> {{ $property->address }}<br>
                                <i class="fa fa-briefcase fa-fw"> </i> {{ $property->company_name }}<br>
                                @if($property->email) <i class="fa fa-envelope fa-fw"> </i> {{ $property->email }}<br> @endif
                                @if($property->phone) <i class="fa fa-phone fa-fw fa-flip-horizontal"> </i> {{ $property->phone }}<br> @endif
                                @if($property->url) <i class="fa fa-globe fa-fw"> </i> <a href="{{ $property->url }}" target="_blank">{{ $property->url }}</a><br> @endif
                                @if($property->facebook_url) <i class="fa fa-facebook fa-fw"> </i> <a href="{{ $property->facebook_url }}" target="_blank"> Facebook </a> <br> @endif

                                @if($servicearray != "")
                                    <br><strong>Teenused: </strong> {{ $servicearray }}
                                @endif</p>
                            <table class="roomstable">
                                <tr style="background-color: #FFFFFF; height: 40px">
                                    <td>Ruumi nimetus</td>
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

                <vue-easy-lightbox
                    :visible="visible"
                    :imgs="imgs"
                    :index="index"
                    @hide="handleHide"
                ></vue-easy-lightbox>
                <!-- result element end -->


            </div>

        </div>

        {{ $properties->appends(request()->query())->links() }}


    </div>

    <script>
        new Vue({
            el: "#list",

            data: {
                visible: false,
                index: 0,
                imgs: []
            },

            methods: {
                showImg(imgs, index) {
                    this.imgs = imgs;
                    this.index = index
                    this.visible = true
                },
                handleHide() {
                    this.visible = false
                }
            }
        })
    </script>
@endsection
