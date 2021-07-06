<div class="content pt-5">
    <div class="row company-archive mt-5">

        @foreach($result as $room)
            <div class="col-3">
                <a href="{{ route('room', $room) }}" style="text-decoration: none">
                    <div class="company-image-container"
                         style="background-image: url('{{ $company->getFirstMediaUrl('cover') }}');">
                    </div>
                </a>
            </div>
        @endforeach


    </div>

    <div class="pagination">
        {{ $result->links() }}
    </div>

</div>
