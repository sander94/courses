@extends('layouts.web')

@section('content')
    <?php
    $scheme = "";
    $link = $company->website;
    $scheme = parse_url($link, PHP_URL_SCHEME);
    if (empty($scheme)) {
        $link = 'http://' . ltrim($company->website, '/');
    }

    ?>

    <style>
        ul, li {
            list-style-type: inherit;
        }
    </style>
    <div class="content pb-5">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="entry-title">{{ $company->name }}</h1>
                <div class="separator-orange"></div>

                <div class="content py-5">
                    <i class="fa fa-briefcase fa-fw"> </i> {{ $company->name }}<br>
                    <i class="fa fa-home fa-fw"> </i> {{ $company->city }}<br>
                    <i class="fa fa-phone fa-fw fa-flip-horizontal"> </i> {{ $company->phone }}<br>
                    <i class="fa fa-envelope fa-fw"> </i> {{ $company->email }}<br><br>
                    <i class="fa fa-globe fa-fw"> </i> <a href="{{ $company->website }}"
                                                          target="_blank">{{ $company->website }}</a><br>
                    <i class="fa fa-facebook fa-fw"> </i> <a href="{{ $company->facebook_url }}" target="_blank">Facebook</a>
                </div>
            </div>
            <div class="col-sm-6 company-page-logo">
                @if($company->getFirstMediaUrl('cover'))
                    <img src="{{ $company->getFirstMediaUrl('cover') }}" alt="{{ $company->logo_title_tag ?? $company->name }}" title="{{ $company->logo_title_tag ?? $company->name }}" class="img-responsive"
                         style="max-width: 100%; max-height: 200px;">
                @endif
            </div>
        </div>

        <div class="row">
            <style>p {
                    margin-bottom: 0;
                }</style>
            <div class="col-12">
                {!! $company->description !!}
            </div>


        </div>

        <div class="row pl-2" id="calendar" style="padding-top: 50px;">
            <div class="button-container">
                @foreach($types as $type)

                    <a href="?type={{ $type->getKey() }}#calendar"
                       class="{{ $selectedCourseType == $type->getKey() ? 'active' : null }}">{{ $type->title }}
                        ({{ $counts[$type->getKey()] }})</a>
                @endforeach
            </div>
            <div class="results-table-container">

                <table border="0" cellpadding="0" cellspacing="0" class="results-table">
                    <tr class="tableheader">

                    @if(!isset($_GET['type']) || $_GET['type'] == 3)
                        <td class="table_course_date">Kuupäev</td>
                    @endif

                        <td class="table_course_name">Pealkiri</td>
                        <td class="table_course_price">Hind</td>
                        <td class="table_course_region">Koht</td>
                        <td class="table_course_company">Ettevõte</td>
                        <!--  <td style="width: 120px;">&nbsp;</td> -->
                    </tr>
                    @forelse($courses as $course)
                        <tr>
                        @if(!isset($_GET['type']) || $_GET['type'] == 3)
                                @if($course->started_at)
                                    <td style="font-weight: 300;">{{ $course->started_at->format('d.m.Y') }}
                                       @if($course->ended_at) - {{ $course->ended_at->format('d.m.Y') }} @endif

                                    </td>
                                @else
                                    <td>
                                        @if($type->getKey() == 2)
                                            Tellitav koolitus
                                        @endif
                                    </td>
                                @endif
                        @endif
                            <td><a class="normal" href="{{ route('course.track', $course) }}"
                                   target="_blank">{{ $course->title }}</a>
                            </td>
                            <td style="font-weight: 300;">
                                    @if($course->price <= 0)
                                        @if(isset($course->started_at))
                                            0.00 €
                                        @else
                                            Kokkuleppel
                                        @endif
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
                                        <div class="small-logo"
                                             style="background-image: url('{{ $course->company->getFirstMediaUrl('cover')  }}');">
                                        </div>
                                    @endif
                                    {{ mb_strimwidth($course->company->name, 0, 20, "...") }}</a></td>


                        <!-- <td> <a href="{{ route('companies.show', $course->company->slug)}}?type=live" class="table-readmore">Loe lisa</a></td> -->
                        </tr>
                    @empty
                        <p>Koolitusi ei leitud</p>

                    @endforelse


                </table>

                <div class="pagination">
                    {{ $courses->appends(request()->query())->links() }}
                </div>

            </div>
        </div>
    </div>

@endsection
