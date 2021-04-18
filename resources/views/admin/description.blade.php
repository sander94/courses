@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12">

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
