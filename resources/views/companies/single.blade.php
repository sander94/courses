@extends('layouts.web')

@section('content')

<div class="content pb-5">
	<div class="row">
		<div class="col-8">
	        <h1 class="entry-title">Ateena koolituskeskus OÜ</h1>
	        <div class="separator-orange"></div>

	        <div class="content mt-5">
	            Company Name<br>
	            Company Address<br>
	            Company telephone<br>
	            <a href="mailto: # ">Company E-mail</a><br><br>
	            <a href="facebook">Facebook</a>
	        </div>
	    </div>
	    <div class="col-4">
	    	COMPANY LOGO
	    </div>
	</div>


        <div class="row">
        	<h3 class="mt-5">This company's upcoming events!</h3>
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
                @if(false)
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
                @else

                    <tr>
                        <td style="font-weight: 300;">12.08.2027 - 13.08.2027
                            <br>4 days
                        </td>
                        <td style="font-weight: 300;">96 hours</td>
                        <td>Nortali autokoolitus algajatele
                        </td>
                        <td style="font-weight: 300;">649 €</td>
                        <td style="font-weight: 300;">Harjumaa</td>
                        <td><a href="#readmore" class="table-readmore">Loe lisa</a></td>
                    </tr>

                @endif


            </table>

            <div class="pagination">
                123 pagination
            </div>

        </div>
        </div>
    </div>

@endsection