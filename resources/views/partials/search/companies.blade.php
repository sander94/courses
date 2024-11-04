<div class="content pt-5">
        <div class="row company-archive mt-5">
            @foreach($result as $company)
                <div class="col-6 col-sm-3 companyhover">
                <a href="{{ route('koolitajad.show', $company) }}" style="text-decoration: none">
                    <div style="background-color: #FFFFFF; position: relative;">
                    <div class="overlay">
                        {{ $company->name }}
                    </div>
                   <div style="padding: 20px;">
                        <div class="company-image-container"
                             style="background-image: url('{{ $company->getFirstMediaUrl('cover') }}');">
                        </div>
                    </div>

                </div>
                 </a>
                </div>
            @endforeach
        </div>

    <div class="pagination">
            {{ $result->appends(request()->query())->links() }}
    </div>

</div>
