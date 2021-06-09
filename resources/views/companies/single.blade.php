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
    <div class="content pb-5">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="entry-title">{{ $company->name }}</h1>
                <div class="separator-orange"></div>

                <div class="content py-5">
                    {{ $company->name }}<br>
                    {{ $company->street }}, {{ $company->city }}, {{ $company->region->title }}<br>
                    {{ $company->phone }}<br>
                    <a href="mailto:{{$company->email}}">{{ $company->email }}</a><br><br>
                    <a href="{{ $link }}">{{ $company->website }}</a><br>
                    <a href="facebook">Facebook</a>
                </div>
            </div>
            <div class="col-sm-6 company-page-logo">
                <img src="{{ $company->getFirstMediaUrl('cover') }}" alt="Company Logo" class="img-responsive" style="max-width: 100%; max-height: 200px;">
            </div>
        </div>

        <div class="row">
<style>p { margin-bottom: 0; }</style>
            <div class="col-12">
                {!! $company->description !!}
            </div>


        </div>

        <div class="row pl-2">
            <div class="button-container">
                <a href="?type=live" class="{{ request()->query('type') !== 'orderable' ? 'active' : null }}">Live-koolitused</a>
                <a href="?type=orderable" class="{{ request()->query('type') === 'orderable' ? 'active' : null }}">Tellitavad koolitused</a>
            </div>
            <div class="results-table-container">

                <table border="0" cellpadding="0" cellspacing="0" class="results-table">
                    <tr class="tableheader">
                        @if(request()->query('type') == 'live')<td class="tableDate">Kuupäev</td> @endif
                    <td class="tableCompany">Koolitaja</td>
                    <td class="tableCourse">Koolitus</td>
                    <td class="tablePrice">Hind</td>
                    <td class="tableRegion">Koht</td>
                    <td class="tableEmpty">&nbsp;</td>
                    </tr>
                        @forelse($courses as $course)
                            <tr>
                                @if($course->started_at) <td style="font-weight: 300;">{{ $course->started_at->format('d.m.Y') }}
                                    - {{ $course->ended_at->format('d.m.Y') }}
                                </td> @endif
                        <td style="font-weight: 300;"><a class="normal" href="{{ route('company', $course->company->slug)}}?type=live">
                                        <div class="small-logo" style="background-image: url({{ $course->company->getFirstMediaUrl('cover')  }});"></div>{{ $course->company->name }}</a></td>
                        <td><a class="normal" href="{{ $course->url }}" target="_blank">{{ $course->title }}</a>
                        </td>
                        <td style="font-weight: 300;">{{ number_format($course->price, 2) }} €</td>
                        <td style="font-weight: 300;">{{ $course->region->title }}</td>
                        <td><a href="{{ route('company', $course->company->slug)}}?type=live" class="table-readmore">Loe lisa</a></td>
                            </tr>
                        @empty
                            <p>Koolitusi ei leitud</p>

                        @endforelse


                </table>

                <div class="pagination">
                    {{ $courses->links() }}
                </div>

            </div>
        </div>
    </div>

@endsection
