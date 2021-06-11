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
                <td style="font-weight: 300;">@if($course->started_at) {{ $course->started_at->format('d.m.Y') }}
                    @if($course->ended_at)
                    - {{ $course->ended_at->format('d.m.Y') }}
                    @endif
                @else
                Tellitav koolitus
                @endif
                </td>
                <td style="font-weight: 300;">
                    <a class="normal" href="{{ route('company', $course->company->slug)}}?type=live">
                    <div class="small-logo" style="background-image: url({{ $course->company->getFirstMediaUrl('cover')  }});"></div>{{ $course->company->name }}
                    </a>
                </td>
                <td><a class="normal" href="{{ $course->url }}" target="_blank">{{ $course->title }}</a>
                        </td>
                        <td style="font-weight: 300;">{{ number_format($course->price, 2) }} €</td>
                        <td style="font-weight: 300;">{{ $course->region->title }}</td>
                        <td><a href="{{ route('company', $course->company->slug)}}?type=live" class="table-readmore">Loe lisa</a></td>
            </tr>
        @endforeach

    </table>

    <div class="pagination">
        {{ $result->links() }}
    </div>

</div>
