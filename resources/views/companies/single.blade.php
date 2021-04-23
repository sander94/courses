@extends('layouts.web')

@section('content')

    <div class="content pb-5">
        <div class="row">
            <div class="col-8">
                <h1 class="entry-title">{{ $company->name }}</h1>
                <div class="separator-orange"></div>

                <div class="content mt-5">
                    {{ $company->name }}<br>
                    {{ $company->street }}, {{ $company->city }}, {{ $company->region->title }}<br>
                    {{ $company->phone }}<br>
                    <a href="mailto:{{$company->email}}">{{ $company->email }}</a><br><br>
                    <a href="facebook">Facebook</a>
                </div>
            </div>
            <div class="col-4">
                <img src="{{ $company->getFirstMediaUrl('cover') }}" alt="Company Logo" class="img-responsive">
            </div>
        </div>

        <div class="row mt-5">

            <div class="col-12">
                {!! $company->description !!}
            </div>


        </div>

        <div class="row">
            <div class="button-container">
                <a href="#" class="active">Live courses</a>
                <a href="#">Orderable courses</a>
            </div>
            <div class="col-12">
                <h3 class="mt-5">Company Name Upcoming events</h3>
            </div>
            <div class="results-table-container">

                <table border="0" cellpadding="0" cellspacing="0" class="results-table">
                    <tr class="tableheader">
                        <td style="width: 150px;">Kuupäev</td>
                        <td style="width: 100px;">Kestus</td>
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
    </div>

@endsection
