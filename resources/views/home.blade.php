@extends('layouts/web')

@section('content')
    <div class="content">

        <div class="row">
            <div class="col-12 pt-0 pt-sm-4">
                <h1 class="text-3xl">Eesti <br>suurim <br>koolituste <br>andmebaas</h1>
                <p class="mt-4">ÜLE 70 000 KURSUSE PARIMATELT KOOLITAJATELT</p>
                <div class="button-container">
                    <a href="{{ route('courses.index') }}" class="home-1 active xl">Vaata koolitusi</a>
                    <a href="{{ route('companies') }}" class="home-1 xl">Koolitajad</a>
                </div>
                <img src="{{ asset('images/koolitused.svg') }}" class="home-image">
            </div>
        </div>


        <div class="row mt-10 text-center">

            <div class="col-12">

                <h2 class="medium-title">Populaarsed kategooriad</h2>
                <div class="separator-orange mx-auto mt-3 mb-5"></div>
                <div class="popular-courses-container">
                    @if(false)
                    @foreach($popularCourses as $course)
                        <a href="#">{{ $course->title }}</a>
                    @endforeach
                    @endif
                    <a href="#">ÄRI- JA ETTEVÕTLUSALASED KOOLITUSED</a>
                    <a href="#">TURUNDUS</a>
                    <a href="#">EHITUS</a>
                    <a href="#">FINANTS</a>
                    <a href="#">KINNISVARA</a>
                    <a href="#">PSÜHHOLOOGIA</a>
                    <a href="#">SOTSIAALTÖÖ</a>
                    <a href="#">TRANSOPRT JA LOGISTIKA</a>
                    <a href="#">FOTOGRAAFIA</a>
                    <a href="#">JUHTIMINE</a>
                    <a href="#">KOKANDUSKURSUSED</a>
                    <a href="#">SEKRETÄRILE</a>
                    <a href="#">KLIENDITEENINDUS</a>
                </div>

            </div>

        </div>


        <div class="row mt-10">

            <div class="col-12">

                <h2 class="medium-title text-center">Uued koolitused</h2>
                <div class="separator-orange mx-auto mt-3 mb-5"></div>

                <div class="results-table-container">

                    <table border="0" cellpadding="0" cellspacing="0" class="results-table">
                        <tr class="tableheader">
                            <td style="width: 150px;">Kuupäev</td>
                            <td>Kestvus</td>
                            <td style="width: 200px;">Koolitaja</td>
                            <td>Koolitus</td>
                            <td style="width: 100px;">Hind</td>
                            <td style="width: 100px;">Koht</td>
                            <td style="width: 120px;">&nbsp;</td>
                        </tr>
                        @forelse($courses->sortByDesc('featuring_ended_at') as $course)
                            <tr>
                                @if($course->started_at && $course->ended_at)
                                    <td style="font-weight: 300;">{{ $course->started_at->format('d.m.Y') }}
                                        - {{ $course->ended_at->format('d.m.Y') }}
                                        
                                    </td>
                                @else
                                    <td>Tellitav koolitus</td>
                                @endif
                                <td style="font-weight: 300;">
                                    @if($course->started_at) {{ $course->ended_at->diffInDays($course->started_at) }}
                                        päeva @endif
                                </td>
                                <td style="font-weight: 300;">
                                    <a class="normal" href="{{ route('company', $course->company->slug)}}?type=live">
                                        <div class="small-logo" style="background-image: url({{ $course->company->getFirstMediaUrl('cover')  }});"></div>{{ $course->company->name }}</a></td>
                                <td><a class="normal" href="{{ $course->url }}" target="_blank">{{ $course->title }}</a>
                                </td>
                                <td style="font-weight: 300;">{{ number_format($course->price, 2) }} €</td>
                                <td style="font-weight: 300;">{{ $course->region->title }}</td>
                                <td><a href="{{ route('company', $course->company->slug)}}?type=live" class="table-readmore">Loe lisa</a></td>
                            </tr>
                        @empty
                            <p>Koolitusi ei ole</p>

                        @endforelse


                    </table>

                </div>

            </div>

        </div>


        <div class="row mt-10 mt-sm-5-1">

            <div class="col-12">

                <h2 class="medium-title text-center">Artiklid ja uudised</h2>
                <div class="separator-orange mx-auto mt-3 mb-5"></div>

                <div class="row blog-archive mt-5">

                    @forelse($articles as $article)
                        <div class="col-12 col-sm-4">
                            <a href="{{ route('articles.show', $article) }}" style="text-decoration: none">
                                <div class="blog-image-container"
                                     style="background-image: url('{{ $article->getFirstMediaUrl('cover') }}');"></div>
                                <span class="blog-title px-2">{{ $article->title }}</span></a>
                            <p class="px-2">{{ strip_tags(substr($article->content, 0, 300)) }}...</p>
                            </a>

                        </div>
                    @empty
                        <p style="margin: 0 auto;">Artikleid ei leitud</p>
                    @endforelse

                </div>


                <div class="button-container text-center">
                    <a href="{{ route('articles.index') }}" class="table-readmore">Vaata kõiki</a>
                </div>

            </div>

        </div>

        <div class="card-rounded mt-10">
            <div class="row">


                <div class="col-12 col-sm-9">
                    <p class="font-bold text-xl">Oled koolitaja või pakute ruume koolitusteks?</p>
                    <p>Palun võtke meiega meilitsi ühendust info@koolitused.ee. Teeme Teile personaalse pakkumise
                        Koolitused.ee andmebaasiga liitumiseks.</p>
                </div>

                <div class="col-12 col-sm-3">
                    <div class="button-container mx-auto mt-sm-5">
                        <a href="{{ route('contact') }}" class="active xl writeToUs">Kirjuta meile</a>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection
