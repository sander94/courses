@extends('layouts.web')

@section('content')
    <div class="content">
        <h1 class="entry-title">{{ $article->title }}</h1>
        <div class="separator-orange"></div>

        <div class="content">
            {!! $article->content !!}
        </div>


        <div class="row">
            @foreach($article->getMedia('gallery') as $key => $media)
                <div class="col-6 p-2">
                    <img class="img-responsive" src="{{ $media->getUrl() }}" alt="Image #{{ $key }}">
                </div>
            @endforeach
        </div>
    </div>
@endsection

