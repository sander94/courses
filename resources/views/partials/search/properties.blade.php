<div class="content pt-5">
    <div class="row company-archive mt-5">

        @foreach($result as $property)
            <div class="col-3">
                <div class="company-image-container"
                     style="background-image: url('{{ $property->getFirstMediaUrl('cover') }}');">
                </div>
            </div>
        @endforeach


    </div>

    <div class="pagination">
        {{ $result->links() }}
    </div>

</div>
