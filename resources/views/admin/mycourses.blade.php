@extends('layouts/web')

@section('content')

    @include('partials.admin.submenu')
    <style>
        .multiselect__tags {
            background: transparent;
            border-radius: 30px;
        }

        .multiselect__tags input[type='text'] {
            border: 0;
        }

        .multiselect {
            width: 60%;
            border: 2px solid #969696;
            border-radius: 30px;
        }

        .mx-datepicker {
            width: 60%;
        }

        .profile-input-row input[type="text"].mx-input {
            width: 100%;
        }
    </style>


    <div class="content p-3">

        <div class="row">

            <div class="col-12">

                <a href="{{ route('createCourse') }}"><i class="fas fa-plus mr-2"> </i>Lisa uus koolitus</a>

            </div>


        </div>


        <div class="row">
            <div class="button-container">
                <a href="?type=live" class="{{ request()->query('type') !== 'orderable' ? 'active' : null }}">Live-koolitused</a>
                <a href="?type=orderable" class="{{ request()->query('type') === 'orderable' ? 'active' : null }}">Tellitavad koolitused</a>
            </div>

            <div class="results-table-container">

                <table border="0" cellpadding="0" cellspacing="0" class="results-table">
                    <tr class="tableheader">
                        @if(request()->query('type') == 'live')<td style="width: 50px;">Kuupäev</td> @endif
                        <td style="width: 100px;">Kestus</td>
                        <td style="width: 250px;">Koolitus</td>
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
                            <td style="font-weight: 300;">{{ round($course->duration_minutes / 60) }} hours</td>
                            <td>{{ $course->title }}
                            </td>
                            <td style="font-weight: 300;">{{ number_format($course->price, 2) }} €</td>
                            <td style="font-weight: 300;">{{ $course->region->title }}</td>
                            <td>
                                <a href="{{ $course->url }}" target="_blank" class="table-readmore">Loe lisa</a>
                                <a href="{{ route('edit_course', $course) }}" class="table-readmore">Muuda</a>
                            </td>
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
