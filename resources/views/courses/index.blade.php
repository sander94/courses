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
                <h1 class="text-3xl">Eesti <br>suurim <br>koolituste <br>andmebaas </h1>
            </div>
            @if($banner)
                <div class="col-sm-8">
                    <a href="{{ route('ad', $banner) }}" target="_blank">
                        <img src="{{ $banner->getFirstMediaUrl('banner') }}" class="advert">
                    </a>
                </div>
            @endif
        </div>
        <style>


        </style>
        <form action="" method="GET" autocomplete="off">
            <div class="filter-container">

                <span id="findCourse" class="filter findCourse"
                      onclick="$('#findCourseContainer').slideToggle();">{{ optional($selectedCategory)->title ?? 'Vali kategooria' }}</span>


                <select id="findLocation" class="filter findLocation" name="type">
                    <option value="">Koolituse tüüp</option>
                    @foreach($types as $type)
                        <option
                            value="{{ $type->getKey() }}" {{ request()->get('type') == $type->getKey() ? 'selected' : null }}>{{ $type->title }}</option>
                    @endforeach
                </select>

                <select id="findLocation" class="filter findLocation" name="region">
                    <option value="">Asukoht</option>
                    @foreach($regions as $region)
                        <option
                            value="{{ $region->getKey() }}" {{ optional($selectedRegion)->getKey() === $region->getKey() ? 'selected' : null }}>{{ $region->title }}</option>
                    @endforeach
                </select>
                <input type="text" id="datepicker" value="{{ request()->query('started_at') }}" class="filter findDate"
                       name="started_at" placeholder="Algusaeg">
                <input type="submit" value="Filtreeri" class="findSubmit">


            </div>

@if(false)
            <div class="text-center mt-4">

                <a href="https://www.koolitused.ee/courses">Kõik koolitused</a> |
                <a href="https://www.koolitused.ee/courses?region=&started_at=&category=129">24/7 e-koolitused</a>

            </div>
@endif

            <div class="findCourseContainer" id="findCourseContainer">
                <ul class="main">
                    @foreach($categories as $category)
                        <li class="main-li">
                            <label><input type="radio" name="category" data-name="{{ $category->title }}" onclick="return changeCategoryValue();"
                                          {{ optional($selectedCategory)->getKey() === $category->getKey() ? 'checked' : null }}
                                          value="{{ $category->getKey() }}">{{ $category->title }}
                            </label>
                            <ul class="sub">
                                @foreach($category->children as $child)
                                    <li><label><input type="radio" name="category" data-name="{{ $child->title }}" onclick="return changeCategoryValue();"
                                                      {{ optional($selectedCategory) === $child->getKey() ? 'checked' : null }}
                                                      value="{{ $child->getKey() }}">{{ $child->title }}</label></li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>

            </div>
        </form>
        <div class="results-table-container">

            <table border="0" cellpadding="0" cellspacing="0" class="results-table">
                <tr class="tableheader">
                    <td class="table_course_date">Kuupäev</td>
                    <td class="table_course_name">Pealkiri</td>
                    <td class="table_course_price">Hind</td>
                    <td class="table_course_region">Koht</td>
                    <td class="table_course_company">Ettevõte</td>
                   <!--  <td style="width: 120px;">&nbsp;</td> -->
                </tr>
                @forelse($courses as $course)
                    <tr>
                                @if($course->started_at)
                                    <td style="font-weight: 300;">{{ $course->started_at->format('d.m.Y') }}
                                       @if($course->ended_at) - {{ $course->ended_at->format('d.m.Y') }} @endif

                                    </td>
                                @else
                                    <td>
                                        <!--
                                        @if(empty($_GET['type']))
                                            {{ $type->getKey() }}
                                        @else
                                            @if($_GET['type'] == 3)
                                                Tellitav koolitus
                                            @endif
                                            @if($_GET['type'] == 2)
                                                Tellitav koolitus
                                            @endif
                                            @if($_GET['type'] == 1)
                                                24/7 koolitus
                                            @endif
                                        @endif
                                        -->

                                        @if($type->getKey() == 3)
                                            Tellitav koolitus
                                        @elseif($type->getKey() == 2)
                                            Tellitav koolitus
                                        @else
                                            24/7 koolitus
                                        @endif
                                    </td>
                                @endif
                                <td><a class="normal" href="{{ route('course.track', $course) }}" target="_blank">{{ $course->title }}</a>
                                </td>
                                <td style="font-weight: 300;">
                                    @if($course->price <= 0)
                                        Kokkuleppel
                                    @else
                                        {{ number_format($course->price, 2) }} €
                                    @endif
                                </td>
                                @if(false)
                                <td style="font-weight: 300;">
                                    @if($course->started_at) {{ $course->ended_at->diffInDays($course->started_at) }}
                                        päeva @endif
                                </td>
                                @endif
                                <td style="font-weight: 300;">{{ $course->region->title }}</td>
                                <td style="font-weight: 300;">
                                    <a class="normal" href="{{ route('companies.show', $course->company->slug)}}">
                                        @if($course->company->getFirstMediaUrl('cover'))
                                        <div class="small-logo" style="background-image: url('{{ $course->company->getFirstMediaUrl('cover')  }}');">
                                        </div>
                                        @endif
                                        {{ mb_strimwidth($course->company->name, 0, 20, "...") }}</a></td>



                                <!-- <td> <a href="{{ route('companies.show', $course->company->slug)}}?type=live" class="table-readmore">Loe lisa</a></td> -->
                    </tr>
                @empty
                    <p style="font-size: 18px; color: red; text-align: center; margin-bottom: 50px;">Koolitusi ei
                        leitud</p>

                @endforelse


            </table>

            <div class="pagination">
                {{ $courses->appends(request()->query())->links() }}
            </div>

        </div>

    </div>
    <script>
        $(function () {
            $("#datepicker").datepicker();
        });
    </script>

   <script>
        $('ul li').click(function () {
            $('#findCourseContainer').slideUp();
        });
    </script>

    <script>
        function changeCategoryValue() {
            var newValue = $('input[name="category"]:checked').attr('data-name');
            $('#findCourse').html(newValue);
        }
    </script>
@endsection
