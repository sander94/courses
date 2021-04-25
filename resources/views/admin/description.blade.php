@extends('layouts.web')

@section('content')

    @include('partials.admin.submenu')

    <div class="content">
        <div class="row">
            <div class="col-12">
                <form id="description" action="{{ route('company.update') }}" method="post">
                    @csrf

                    <input type="hidden" name="description">

                    <div id="editor-container">
                        {!! $company->description  !!}
                    </div>
                    <br>
                    <button>Submit</button>
                </form>


            </div>
        </div>
    </div>

@endsection

@push('css-after')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@push('js')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        const quill = new Quill('#editor-container', {
            modules: {
                toolbar: [
                    [{header: [1, 2, false]}],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },
            placeholder: 'Compose an epic...',
            theme: 'snow'  // or 'bubble'
        });

        const form = document.querySelector('#description');
        form.onsubmit = function () {
            // Populate hidden form on submit
            var about = document.querySelector('input[name=description]');
            about.value = quill.container.querySelector('.ql-editor').innerHTML;
        };

    </script>
@endpush
