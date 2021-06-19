<div class="content pt-5">
    <div class="row blog-archive mt-5">

        @foreach($result as $article)
                <div class="col-4">
                    <a href="{{ route('articles.show', $article) }}" style="text-decoration: none">
                        <div class="blog-image-container"
                             style="background-image: url('{{ $article->getFirstMediaUrl('cover') }}');"></div>
                        <span class="blog-title">{{ $article->title }}</span></a>
                        <p>{{ strip_tags(substr(strip_tags($article->content), 0, 300)) }}...</p>
                    

                </div>
        @endforeach


    </div>

    <div class="pagination">
        {{ $result->links() }}
    </div>

</div>
