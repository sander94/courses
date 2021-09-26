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
                @foreach($types as $type)
                    <a href="?type={{ $type->getKey() }}" class="{{ request()->query('type') !== $type->getKey() ? 'active' : null }}">{{ $type->title }}</a>
                @endforeach
            </div>

            <div class="results-table-container">

                <table border="0" cellpadding="0" cellspacing="0" class="results-table">
                    <tr class="tableheader">
                        @if(request()->query('type') == 'live')
                            <td style="width: 50px;">Kuupäev</td> @endif
                        <td style="width: 250px;">Koolitus</td>
                        <td style="width: 100px;">Hind</td>
                        <td style="width: 100px;">Koht</td>
                        <td style="width: 40px;">Klikke</td>
                        <td style="width: 120px;">&nbsp;</td>
                    </tr>
                    @forelse($courses as $course)
                        <tr>
                            @if($course->started_at)
                                <td style="font-weight: 300;">
                                    {{ $course->started_at->format('d.m.Y') }}
                                    @if($course->ended_at) - {{ $course->ended_at->format('d.m.Y') }} @endif


                                </td> @endif
                            <td><a href="{{ $course->url }}" target="_blank">{{ $course->title }}</a>
                            </td>
                            <td style="font-weight: 300;">{{ number_format($course->price, 2) }} €</td>
                            <td style="font-weight: 300;">{{ $course->region->title }}</td>
                            <td>{{ views($course)->count() }}</td>
                            <td>
                                <form action="{{ route('modifyCourse') }}" method="post" class="duplicatorForm">
                                    @csrf
                                    <input type="hidden" value="{{ $course->id }}" name="course">
                                    <input type="hidden" value="clone" name="action">
                                    <button type="submit" name="submit"><i class="fa fa-clone"></i></button>
                                </form>
                                <a href="{{ route('edit_course', $course) }}" class="editbutton"><i
                                        class="fa fa-pencil"></i></a>
                                <form action="{{ route('modifyCourse') }}" method="post" class="duplicatorForm"
                                      onsubmit="return confirm('Kas oled kindel, et soovid koolituse kustutada?');">
                                    @csrf
                                    <input type="hidden" value="{{ $course->id }}" name="course">
                                    <input type="hidden" value="delete" name="action">
                                    <button type="submit" name="submit"><i class="fa fa-trash-alt"></i></button>
                                </form>
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
