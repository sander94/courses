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
                    <a href="{{ route('ad', $banner) }}">
                        <img src="{{ $banner->getFirstMediaUrl('banner') }}" class="advert">
                    </a>
                </div>
            @endif
        </div>
        <style>


        </style>
        <form action="" method="GET">
            <div class="filter-container">

                <span id="findCourse" class="filter findCourse"
                      onclick="$('#findCourseContainer').slideToggle();">{{ optional($selectedCategory)->title ?? 'Vali kategooria' }}</span>


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


            <div class="findCourseContainer" id="findCourseContainer">
                <ul class="main">
                    @foreach($categories as $category)
                        <li class="main-li">
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
                        <td style="font-weight: 300;">{{ $course->company->name }}</td>
                        <td>{{ $course->title }}
                        </td>
                        <td style="font-weight: 300;">{{ number_format($course->price, 2) }} €</td>
                        <td style="font-weight: 300;">{{ $course->region->title }}</td>
                        <td><a href="{{ $course->website }}" class="table-readmore">Loe lisa</a></td>
                    </tr>
                @empty
                    <p style="font-size: 18px; color: red; text-align: center; margin-bottom: 50px;">Koolitusi ei
                        leitud</p>

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
