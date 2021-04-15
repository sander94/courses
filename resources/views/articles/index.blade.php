@extends('layouts.web')

@section('content')

    <div class="content">
        <h1 class="entry-title text-center">Artiklid</h1>
        <div class="separator-orange mx-auto"></div>

        <div class="row blog-archive mt-5">

            @foreach($articles as $article)
                <div class="col-4">
                    <a href="{{ route('articles.show', $article) }}" style="text-decoration: none">
                        <div class="blog-image-container"
                             style="background-image: url('{{ $article->getFirstMediaUrl('cover') }}');"></div>
                        <span class="blog-title">{{ $article->title }}</a>
                        <p>{{ $article->content }}</p>
                    </a>

                </div>
            @endforeach


        </div>

        <div class="pagination">
            {{ $articles->links() }}
        </div>

    </div>

@endsection
