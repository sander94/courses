<div class="content pt-5">
    <div class="row company-archive mt-5">
         <style>
          
        </style>

        <div class="row mt-3" id="list" style="text-align: left;">

            <div class="col-12">

                <!-- result element -->

                @foreach($result as $property)

                    @php
                        $servicearray = $property->services->implode('title',',');
                        $servicearray = strtolower($servicearray);
                        $servicearray = str_replace(',', ', ', $servicearray);
                    @endphp

                    <div class="row mt-5">
                        <div class="col-12 col-md-3">
                            <h3 class="text-orange hidedesktop">{{ $property->name }}</h3>
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
                            <h3 class="text-orange hidemobile">{{ $property->name }}</h3>
                            <p class="property-data"><i class="fa fa-home fa-fw"> </i> {{ $property->address }}<br>
                                <i class="fa fa-briefcase fa-fw"> </i> {{ $property->company_name }}<br>
                                @if($property->email) <i class="fa fa-envelope fa-fw"> </i> {{ $property->email }}<br> @endif
                                @if($property->phone) <i class="fa fa-phone fa-fw fa-flip-horizontal"> </i> {{ $property->phone }}<br> @endif
                                @if($property->url) <i class="fa fa-globe fa-fw"> </i> <a href="{{ $property->url }}" target="_blank">{{ $property->url }}</a><br> @endif
                                @if($property->facebook_url) <i class="fa fa-facebook fa-fw"> </i> <a href="{{ $property->facebook_url }}" target="_blank"> Facebook </a> <br> @endif

                                @if($servicearray != "")
                                    <br><strong>Teenused: </strong> {{ $servicearray }}
                                @endif</p>
                            @if($property->rooms->count() > 0)
                            <table class="roomstable">
                                <tr style="background-color: #FFFFFF; height: 40px">
                                    <td class="room_name">Ruum</td>
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
                                        <td class="room_name">{{ $room->name }}</td>
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
                            @endif
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
