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
        @foreach($result as $course)
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
        @endforeach

    </table>

    <div class="pagination">
        {{ $result->links() }}
    </div>

</div>
