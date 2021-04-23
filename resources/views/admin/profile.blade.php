@extends('layouts.web')

@section('content')

@include('partials.admin.submenu')

<div class="content">

    <h1 class="entry-title">Kasutaja: {{ Auth::user()->email }}</h1>
    <div class="separator-orange"></div>





    <form action="{{ route('company.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="row mt-5">
                <div class="col-4">
                    <label>
                        <p>Company name</p>
                        <input type="text" value="{{ $company->name }}" name="name">
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <label>
                        <p>Phone</p>
                        <input type="text" value="{{ $company->phone }}" name="phone">
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <label>
                        <p>Website</p>
                        <input type="text" value="{{ $company->website }}" name="website">
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <label>
                        <p>E-mail address</p>
                        <input type="email" value="{{ $company->email }}" name="email">
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <label>
                        <p>Reg no</p>
                        <input type="text" value="{{ $company->reg_number }}" name="reg_number">
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <label>
                        <p>Brand name</p>
                        <input type="text" value="{{ $company->brand }}" name="brand">
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <label>
                        <p>County (region)</p>
                        <select>
                            @foreach($regions as $region)
                                <option
                                    value="{{ $region->getKey() }}" {{ $region->getkey() === $company->region_id ? 'selected' : null }}>{{ $region->title }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <label>
                        <p>City</p>
                        <input type="text" value="{{ $company->city }}" name="city">
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <label>
                        <p>Street address</p>
                        <input type="text" value="{{ $company->street }}" name="street">
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <label>
                        <p>Postal code</p>
                        <input type="text" value="{{ $company->postal }}" name="postal">
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <label>
                        <p>Logo</p>
                        <input type="file" name="cover">
                    </label>
                </div>
            </div>
        </div>

        <button>Submit</button>

    </form>
</div>  

@endsection
