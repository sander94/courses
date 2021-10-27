@extends('layouts.web')

@section('content')

<style>
img {
    max-width: 100%;
    height: auto;
}
</style>

    <div class="content">
        <h1 class="entry-title">{{ $article->title }}</h1>
        <div class="separator-orange"></div>

        <div class="content pt-5">
            {!! $article->content !!}
        </div>


        <div class="row mt-5">
            @foreach($article->getMedia('gallery') as $key => $media)
                <div class="col-6 p-2">
                    <img class="img-responsive" src="{{ $media->getUrl() }}" alt="Image #{{ $key }}" style="max-width: 100%;">
                </div>
            @endforeach
        </div>
    </div>
@endsection

