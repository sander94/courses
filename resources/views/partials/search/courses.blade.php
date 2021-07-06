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
        @foreach($result as $course)
            <tr>
                                                @if($course->started_at && $course->ended_at)
                                    <td style="font-weight: 300;">{{ $course->started_at->format('d.m.Y') }}
                                        - {{ $course->ended_at->format('d.m.Y') }}

                                    </td>
                                @else
                                    <td>Tellitav koolitus</td>
                                @endif
                                <td><a class="normal" href="{{ route('course.track', $course) }}" target="_blank">{{ $course->title }}</a>
                                </td>
                                <td style="font-weight: 300;">{{ number_format($course->price, 2) }} €</td>
                                @if(false)
                                <td style="font-weight: 300;">
                                    @if($course->started_at) {{ $course->ended_at->diffInDays($course->started_at) }}
                                        päeva @endif
                                </td>
                                @endif
                                <td style="font-weight: 300;">{{ $course->region->title }}</td>
                                <td style="font-weight: 300;">
                                    <a class="normal" href="{{ route('company', $course->company->slug)}}?type=live">
                                        @if($course->company->getFirstMediaUrl('cover'))
                                        <div class="small-logo" style="background-image: url({{ $course->company->getFirstMediaUrl('cover')  }});">
                                        </div>
                                        @endif
                                        {{ mb_strimwidth($course->company->name, 0, 20, "...") }}</a></td>



                                <!-- <td> <a href="{{ route('company', $course->company->slug)}}?type=live" class="table-readmore">Loe lisa</a></td> -->
            </tr>
        @endforeach

    </table>

    <div class="pagination">
        {{ $result->links() }}
    </div>

</div>
