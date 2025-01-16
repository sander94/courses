<div class="results-table-container">

    <table border="0" cellpadding="0" cellspacing="0" class="results-table">
        <tr class="tableheader">
            @if(!isset($_GET['course_type']) || $_GET['course_type'] == 3)
                <td class="table_course_date">Kuupäev</td>
            @endif
            <td class="table_course_name">Pealkiri</td>
            <td class="table_course_price">Hind</td>
            <td class="table_course_region">Koht</td>
            <td class="table_course_company">Ettevõte</td>
            <!--  <td style="width: 120px;">&nbsp;</td> -->
        </tr>
        @foreach($result as $course)
            <tr>
                        @if(!isset($_GET['course_type']) || $_GET['course_type'] == 3)
                                @if($course->started_at)
                                    <td style="font-weight: 300;">{{ $course->started_at->format('d.m.Y') }}
                                       @if($course->ended_at) - {{ $course->ended_at->format('d.m.Y') }} @endif

                                    </td>
                                @else
                                    <td>
                                        
                                            Tellitav koolitus
                                      
                                    </td>
                                @endif
                        @endif
                <td><a class="normal" href="{{ route('course.track', $course) }}"
                       target="_blank">{{ $course->title }}</a>
                </td>
                <td style="font-weight: 300;">
                    @if($course->price <= 0)
                        @if(isset($course->started_at))
                            0.00
                        @else
                            Kokkuleppel
                        @endif
                    @else
                        {{ number_format($course->price, 2) }} €
                    @endif
                </td>
                @if(false)
                    <td style="font-weight: 300;">
                        @if($course->started_at) {{ $course->ended_at->diffInDays($course->started_at) }}
                        päeva @endif
                    </td>
                @endif
                <td style="font-weight: 300;">{{ $course->region->title }}</td>
                <td style="font-weight: 300;">
                    @if($course->company)
                        <a class="normal" href="{{ route('companies.show', $course->company)}}">
                            @if($course->company->getFirstMediaUrl('cover'))
                                <div class="small-logo"
                                     style="background-image: url('{{ $course->company->getFirstMediaUrl('cover')  }}');">
                                </div>
                            @endif
                            {{ mb_strimwidth($course->company->name, 0, 20, "...") }}</a>
                    @endif
                </td>


            </tr>
        @endforeach

    </table>

    <div class="pagination">
        {{ $result->appends(request()->query())->links() }}
    </div>

</div>
