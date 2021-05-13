@extends('layouts.web')

@section('content')

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
                        @if(request()->query('type') == 'live')<td style="width: 150px;">Kuupäev</td> @endif
                        <td style="width: 100px;">Kestus</td>
                        <td>Koolitus</td>
                        <td style="width: 100px;">Hind</td>
                        <td style="width: 100px;">Koht</td>
                        <td style="width: 120px;">&nbsp;</td>
                    </tr>
                        @forelse($courses as $course)
                            <tr>
                                @if($course->started_at) <td style="font-weight: 300;">{{ $course->started_at->format('d.m.Y') }}
                                    - {{ $course->ended_at->format('d.m.Y') }}
                                    <br>{{ $course->ended_at->diffInDays($course->started_at) }}
                                    päeva
                                </td> @endif
                                <td style="font-weight: 300;">{{ round($course->duration_minutes / 60) }} tundi</td>
                                <td>{{ $course->title }}
                                </td>
                                <td style="font-weight: 300;">{{ number_format($course->price, 2) }} €</td>
                                <td style="font-weight: 300;">{{ $course->region->title }}</td>
                                <td><a href="{{ $course->url }}" target="_blank" class="table-readmore">Loe lisa</a></td>
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
