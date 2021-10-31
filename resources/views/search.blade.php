@extends('layouts/web')

@section('content')

<style>

.has-results {
    background-color: #bf4f33;
    border-color: #bf4f33;
    color: #FFFFFF !important;
}

</style>

    <div class="content">
        @if($searchQuery)
            <h1 class="entry-title">Otsingu tulemused “<span class="text-orange">{{ $searchQuery }}</span>”</h1>
            <div class="separator-orange"></div>
        @endif
        <div class="button-container">
            <a href="{{ route('search', ['type' => 'companies', 'search' => $searchQuery]) }}"
               class="{{ $type ==='companies' ? 'active' : null }} @if($counters['companies'] > 0) has-results @endif">Koolitajad
                ({{ $counters['companies'] }})</a>
            @foreach($types as $courseType)

            @php 

                $thecount = $counters["courses/{$courseType->getKey()}"];

            @endphp
                <a href="{{ route('search', ['type' => 'courses', 'search' => $searchQuery, 'course_type' => $courseType->getKey()]) }}"
                   class="{{ $courseType->getKey() == $selectedCourseType ? 'active' : null }} @if($thecount > 0) has-results @endif"> {{ $courseType->title }}
                    ({{ $counters["courses/{$courseType->getKey()}"] }})</a>
            @endforeach
            <a href="{{ route('search', ['type' => 'articles', 'search' => $searchQuery]) }}"
               class="{{ $type ==='articles' ? 'active' : null }} @if($counters['articles'] > 0) has-results @endif">Artiklid
                ({{ $counters['articles'] }})</a>
            <a href="{{ route('search', ['type' => 'properties', 'search' => $searchQuery]) }}"
               class="{{ $type ==='properties' ? 'active' : null }} @if($counters['properties'] > 0) has-results @endif">Ruumid
                ({{ $counters['properties'] }})</a>

        </div>

        @includeWHen($type === 'courses', 'partials.search.courses')
        @includeWHen($type === 'articles', 'partials.search.articles')
        @includeWHen($type === 'companies', 'partials.search.companies')
        @includeWHen($type === 'properties', 'partials.search.properties')

    </div>

@endsection
