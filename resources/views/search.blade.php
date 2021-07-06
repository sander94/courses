@extends('layouts/web')

@section('content')

    <div class="content">
        @if($searchQuery)
            <h1 class="entry-title">Otsingu tulemused “<span class="text-orange">{{ $searchQuery }}</span>”</h1>
            <div class="separator-orange"></div>
        @endif
        <div class="button-container">
            <a href="{{ route('search', ['type' => 'companies', 'search' => $searchQuery]) }}"
               class="{{ $type ==='companies' ? 'active' : null }}">Koolitajad
                ({{ $counters['companies'] }})</a>
            <a href="{{ route('search', ['type' => 'courses', 'search' => $searchQuery]) }}"
               class="{{ $type ==='courses' ? 'active' : null }}">Koolitused
                ({{ $counters['courses'] }})</a>
            <a href="{{ route('search', ['type' => 'articles', 'search' => $searchQuery]) }}"
               class="{{ $type ==='articles' ? 'active' : null }}">Artiklid
                ({{ $counters['articles'] }})</a>
            <a href="{{ route('search', ['type' => 'properties', 'search' => $searchQuery]) }}"
               class="{{ $type ==='properties' ? 'active' : null }}">Properties
                ({{ $counters['properties'] }})</a>

        </div>

        @includeWHen($type === 'courses', 'partials.search.courses')
        @includeWHen($type === 'articles', 'partials.search.articles')
        @includeWHen($type === 'companies', 'partials.search.companies')
        @includeWHen($type === 'properties', 'partials.search.properties')

    </div>

@endsection
