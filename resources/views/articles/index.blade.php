@extends('layouts.web')

@section('content')

    <div class="content">
        <h1 class="entry-title text-center">Artiklid</h1>
        <div class="separator-orange mx-auto"></div>

        <div class="row blog-archive mt-5">

            @foreach($articles as $article)
                <div class="col-12 col-sm-4">
                    <a href="{{ route('artiklid.show', $article) }}" style="text-decoration: none">
                        <div class="blog-image-container"
                             style="background-image: url('{{ $article->getFirstMediaUrl('cover') }}');"></div>
                        <span class="blog-title">{{ $article->title }}</span></a>
                        <p>{{ strip_tags(substr(strip_tags($article->content), 0, 200)) }}...</p>


                </div>
            @endforeach


        </div>

        <div class="pagination">
            {{ $articles->links() }}
        </div>

    </div>

@endsection
