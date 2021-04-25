@extends('layouts/web')

@section('content')

    <div class="content">

        <div class="row">
            <div class="col-12 pt-4">
                <h1 class="text-3xl">Eesti<br>suurim<br>koolituste<br>andmebaas</h1>
                <p class="mt-4">ÜLE 70 000 KURSUSE PARIMATELT KOOLITAJATELT</p>
                <div class="button-container">
                    <a href="{{ route('courses.index') }}" class="active xl">See courses</a>
                    <a href="{{ route('companies') }}" class="xl">Companies</a>
                </div>
                <img src="{{ asset('images/koolitused.svg') }}"
                     style="position: absolute; top: 0; z-index: -1; right: 0; width: 80%;">
            </div>
        </div>


        <div class="row mt-10 text-center">

            <div class="col-12">

                <h2 class="medium-title">Popular Courses</h2>
                <div class="separator-orange mx-auto mt-3 mb-5"></div>
                <div class="popular-courses-container">
                    @foreach($popularCourses as $course)
                        <a href="#">{{ $course->title }}</a>
                    @endforeach
                </div>

            </div>

        </div>


        <div class="row mt-10">

            <div class="col-12">

                <h2 class="medium-title text-center">New Courses</h2>
                <div class="separator-orange mx-auto mt-3 mb-5"></div>

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

                </div>

            </div>

        </div>


        <div class="row mt-10">

            <div class="col-12">

                <h2 class="medium-title text-center">Articles</h2>
                <div class="separator-orange mx-auto mt-3 mb-5"></div>

                <div class="row blog-archive mt-5">

                    @foreach($articles as $article)
                        <div class="col-4">
                            <a href="{{ route('articles.show', $article) }}" style="text-decoration: none">
                                <div class="blog-image-container"
                                     style="background-image: url('{{ $article->getFirstMediaUrl('cover') }}');"></div>
                                <span class="blog-title">{{ $article->title }}</span></a>
                            <p>{{ substr($article->content, 0, 300) }}...</p>
                            </a>

                        </div>
                    @endforeach

                </div>


                <div class="button-container text-center">
                    <a href="{{ route('articles.index') }}" class="table-readmore">Vaata kõiki</a>
                </div>

            </div>

        </div>

        <div class="card-rounded mt-10">
            <div class="row">


                <div class="col-9">
                    <p class="font-bold text-xl">Oled koolitaja või pakute ruume koolitusteks?</p>
                    <p>Palun võtke meiega meilitsi ühendust info@koolitused.ee. Teeme Teile personaalse pakkumise
                        Koolitused.ee andmebaasiga liitumiseks.</p>
                </div>

                <div class="col-3">
                    <div class="button-container mx-auto mt-5">
                        <a href="{{ route('contact') }}" class="active xl">Kirjuta meile</a>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection
