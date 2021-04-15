<div class="content">
    <div class="row blog-archive mt-5">

        @foreach($result as $article)
            <div class="col-4">

                <div class="blog-image-container"
                     style="background-image: url('{{ $article->getFirstMediaUrl('cover') }}');"></div>
                <a href="{{ route('articles.show', $article) }}" class="blog-title">{{ $article->title }}</a>
                <p>{{ $article->content }}</p>

            </div>
        @endforeach


    </div>

    <div class="pagination">
        {{ $result->links() }}
    </div>

</div>
