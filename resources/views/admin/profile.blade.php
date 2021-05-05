@extends('layouts.web')

@section('content')

@include('partials.admin.submenu')

<div class="content">

    <div class="title-container">
        <div class="title-logo">
            @if($company->getFirstMediaUrl('cover'))
                <div class="logo-pilt" style="background-image: url('{{ $company->getFirstMediaUrl('cover') }}');"> </div>
            @endif
        </div>
        <div class="title">
            <h1 class="entry-title">Kasutaja: {{ Auth::user()->email }}</h1>
            <div class="separator-orange"></div>
        </div>
    </div>

    <form action="{{ route('company.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content" style="margin-top: 40px;">

            <div class="row">

                <div class="col-6">

                    <div class="row profile-row">
                        <div class="col-12">
                            <label class="profile-input-row">
                                <div class="input-desc">
                                    Company name
                                </div>
                                <input type="text" value="{{ $company->name }}" name="name">
                            </label>
                        </div>
                    </div>

                    <div class="row profile-row">
                        <div class="col-12">
                            <label class="profile-input-row">
                                <div class="input-desc">
                                    Phone
                                </div>
                                <input type="text" value="{{ $company->phone }}" name="phone">
                            </label>
                        </div>
                    </div>

                    <div class="row profile-row">
                        <div class="col-12">
                            <label class="profile-input-row">
                                <div class="input-desc">
                                    Website
                                </div>
                                <input type="text" value="{{ $company->website }}" name="website">
                            </label>
                        </div>
                    </div>

                    <div class="row profile-row">
                        <div class="col-12">
                            <label class="profile-input-row">
                                <div class="input-desc">
                                    E-mail address
                                </div>
                                <input type="email" value="{{ $company->email }}" name="email">
                            </label>
                        </div>
                    </div>


                    <div class="row profile-row">
                        <div class="col-12">
                            <label class="profile-input-row">
                                <div class="input-desc">
                                    Reg no
                                </div>
                                <input type="text" value="{{ $company->reg_number }}" name="reg_number">
                            </label>
                        </div>
                    </div>

                    <div class="row profile-row">
                        <div class="col-12">
                            <label class="profile-input-row">
                                <div class="input-desc">
                                    Brand name
                                </div>
                                <input type="text" value="{{ $company->brand }}" name="brand">
                            </label>
                        </div>
                    </div>


                </div>

                <div class="col-6">

                    <div class="row profile-row">
                        <div class="col-12">
                            <label class="profile-input-row">
                                <div class="input-desc">
                                    County
                                </div>
                                <select name="region_id">
                                    @foreach($regions as $region)
                                        <option
                                            value="{{ $region->getKey() }}" {{ $region->getkey() === $company->region_id ? 'selected' : null }}>{{ $region->title }}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                    </div>

                    <div class="row profile-row">
                        <div class="col-12">
                            <label class="profile-input-row">
                                <div class="input-desc">
                                    City
                                </div>
                                <input type="text" value="{{ $company->city }}" name="city">
                            </label>
                        </div>
                    </div>

                    <div class="row profile-row">
                        <div class="col-12">
                            <label class="profile-input-row">
                                <div class="input-desc">
                                    Street address
                                </div>
                                <input type="text" value="{{ $company->street }}" name="street">
                            </label>
                        </div>
                    </div>

                    <div class="row profile-row">
                        <div class="col-12">
                            <label class="profile-input-row">
                                <div class="input-desc">
                                    Postal code
                                </div>
                                <input type="text" value="{{ $company->postal }}" name="postal">
                            </label>
                        </div>
                    </div>

                    <div class="row profile-row">
                        <div class="col-12">
                            <label class="profile-input-row">
                                <div class="input-desc">
                                    Logo
                                </div>
                                <input type="file" name="cover">
                            </label>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-12">
                                <button class="submit">SALVESTA</button>
                        </div>

                    </div>

                </div>

            </div>




        </div>


    </form>
</div>  

@endsection
