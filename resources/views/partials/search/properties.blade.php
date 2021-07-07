<div class="content pt-5">
    <div class="row company-archive mt-5">
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
<div id="list">
        @foreach($result as $property)
                    @php
                        $media = $property->getMedia('gallery');
                        $urls = $media->map->getUrl();
                    @endphp
                    @php
                        $servicearray = $property->services->implode('title',',');
                        $servicearray = strtolower($servicearray);
                        $servicearray = str_replace(',', ', ', $servicearray);
                    @endphp
                    <div class="row mt-5">
                        <div class="col-3">
                            <div class="room-image"
                                 style="background-image: url('{{ $property->getFirstMediaUrl('cover') }}');">
                            </div>

                            @php
                                $media = $property->getMedia('gallery');
                                $urls = $media->map->getUrl();
                            @endphp

                            <div style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); column-gap: 5px; row-gap: 5px;">
                            @foreach($urls as $index => $url)
                                <img @click="showImg({{ json_encode($urls) }}, {!! $index !!})" class="galleryboxImg" src="{{ $url }}">
                            @endforeach
                            </div>
                        </div>
                        <div class="col-9">
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
</div>


    </div>

    <div class="pagination">
        {{ $result->links() }}
    </div>

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
