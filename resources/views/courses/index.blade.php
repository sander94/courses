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
        <form action="" method="GET" autocomplete="off">
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
                    <td class="tableDate">Kuupäev</td>
                    <td class="tableCompany">Koolitaja</td>
                    <td class="tableCourse">Koolitus</td>
                    <td class="tablePrice">Hind</td>
                    <td class="tableRegion">Koht</td>
                    <td class="tableEmpty">&nbsp;</td>
                </tr>
                @forelse($courses as $course)
                    <tr>
                        <td style="font-weight: 300;">{{ $course->started_at->format('d.m.Y') }}
                            @if($course->ended_at)
                                - {{ $course->ended_at->format('d.m.Y') }}
                            @endif
                        </td>
                        <td style="font-weight: 300;"><a class="normal"
                                                         href="{{ route('company', $course->company->slug)}}?type=live">
                                <div class="small-logo"
                                     style="background-image: url({{ $course->company->getFirstMediaUrl('cover')  }});"></div>{{ $course->company->name }}
                            </a></td>
                        <td><a class="normal" href="{{ route('course.track', $course) }}"
                               target="_blank">{{ $course->title }}</a>
                        </td>
                        <td style="font-weight: 300;">{{ number_format($course->price, 2) }} €</td>
                        <td style="font-weight: 300;">{{ $course->region->title }}</td>
                        <td><a href="{{ route('company', $course->company->slug)}}?type=live" class="table-readmore">Loe
                                lisa</a></td>
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
