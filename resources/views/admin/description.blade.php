@extends('layouts.web')

@section('content')

@include('partials.admin.submenu')

    <div class="content">
        <div class="row">
            <div class="col-12">
                        Here we need some WYSIWYG editor, where user can also add images inside.<br>

                        <a href="https://quilljs.com" target="_blank">https://quilljs.com</a><br>
                        <a href="https://www.cssscript.com/demo/minimal-wysiwyg-editor-pure-javascript-suneditor/" target="_blank">https://www.cssscript.com/demo/minimal-wysiwyg-editor-pure-javascript-suneditor/</a>
                <form action="{{ route('company.update') }}" method="post">
                    @csrf
                    <textarea name="description" style="width: 400px; height: 300px;">
                    {{ $company->description }}
				    </textarea><br>
                    <button>Submit</button>
                </form>


            </div>
        </div>
    </div>

@endsection
