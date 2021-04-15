@extends('layouts.web')

@php
    /** @var \App\Services\BannerService $bannerService */
    $bannerService = app(\App\Services\BannerService::class);
    $banner = $bannerService->randomBanner();
@endphp

@section('content')

    <div class="content">
        <div class="row">
            <div class="col-4 pt-4">
                <h1 class="text-3xl">Eesti<br>suurim<br>koolituste<br>andmebaas</h1>
            </div>
            @if($banner)
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
                width: 1000px;
                margin: 0 auto;
                margin-top: 40px;
                justify-content: center;
            }

            .filter {
                padding: 10px 20px;
                border: 2px solid #F66F4D;
                border-radius: 30px;
                margin-left: 10px;
                margin-right: 10px;
            }

            .findCourse {
                width: 300px;
            }

            .findLocation {
                width: 200px;
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
            }

            .findCourseContainer {
                background-color: #F66F4D;
                width: 100%;
                display: none;
                margin-top: 30px;
                padding: 50px;
            }

            ul, li {
                list-style-type: none;
            }

            }
        </style>
        <form action="" method="GET">
            <div class="filter-container">

                <span id="findCourse" class="filter findCourse"
                      onclick="$('#findCourseContainer').slideToggle();">{{ optional($selectedCategory)->title ?? 'Choose category' }}</span>


                <select id="findLocation" class="filter findLocation" name="region">
                    <option value="0">Location</option>
                    @foreach($regions as $region)
                        <option
                            value="{{ $region->getKey() }}" {{ optional($selectedRegion)->getKey() === $region->getKey() ? 'checked' : null }}>{{ $region->title }}</option>
                    @endforeach
                </select>
                <input type="text" id="datepicker" class="filter findDate" name="started_at" placeholder="Start date">
                <input type="submit" value="Filtreeri" class="findSubmit">


            </div>


            <div class="findCourseContainer" id="findCourseContainer">
                <ul class="main">
                    @foreach($categories as $category)
                        <li>
                            <label><input type="radio" name="category"
                                          {{ optional($selectedCategory)->getKey() === $category->getKey() ? 'checked' : null }}
                                          value="{{ $category->getKey() }}">{{ $category->title }}
                            </label>
                            <ul class="sub">
                                @foreach($category->children as $child)
                                    <li><label><input type="radio" name="category"
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
                    <td style="width: 150px;">Kuupäev</td>
                    <td style="width: 100px;">Kestus</td>
                    <td style="width: 200px;">Koolitaja</td>
                    <td>Koolitus</td>
                    <td style="width: 100px;">Hind</td>
                    <td style="width: 100px;">Koht</td>
                    <td style="width: 120px;">&nbsp;</td>
                </tr>
                @forelse($courses as $course)
                    <tr>
                        <td style="font-weight: 300;">{{ $course->started_at->format('d.m.Y') }}
                            - {{ $course->ended_at->format('d.m.Y') }}
                            <br>{{ $course->ended_at->diffInDays($course->started_at) }}
                            days
                        </td>
                        <td style="font-weight: 300;">{{ round($course->duration_minutes / 60) }} hours</td>
                        <td style="font-weight: 300;">NORT koolitus (company name)</td>
                        <td>{{ $course->title }}
                        </td>
                        <td style="font-weight: 300;">{{ number_format($course->price, 2) }} €</td>
                        <td style="font-weight: 300;">{{ $course->region->title }}</td>
                        <td><a href="#readmore" class="table-readmore">Loe lisa</a></td>
                    </tr>
                @empty
                    <p>No Courses Found</p>

                @endforelse


            </table>

            <div class="pagination">
                {{ $courses->links() }}
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
@endsection
