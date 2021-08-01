@extends('layouts.web')

@section('content')

@include('partials.admin.submenu')

<div class="content p-0 mt-4">

    <div class="title-container">
        <div class="title-logo">
            @if($company->getFirstMediaUrl('cover'))
                <div class="logo-pilt" style="background-image: url('{{ $company->getFirstMediaUrl('cover') }}');"> </div>
            @endif
        </div>
        <div class="title">
            <h1 class="entry-title">Kasutaja: {{ Auth::user()->username }}</h1>
            <div class="separator-orange"></div>
        </div>
    </div>

    <form action="{{ route('company.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mt-4 p-4" style="">

            <div class="row">

                <div class="col-12 col-md-6">

                    <div class="row profile-row">
                        <div class="col-12">
                            <label class="profile-input-row">
                                <div class="input-desc">
                                    Ettevõtte nimi
                                </div>
                                <input type="text" value="{{ $company->name }}" name="name">
                            </label>
                        </div>
                    </div>

                    <div class="row profile-row">
                        <div class="col-12">
                            <label class="profile-input-row">
                                <div class="input-desc">
                                    Aadress
                                </div>
                                <input type="text" value="{{ $company->city }}" name="street">
                            </label>
                        </div>
                    </div>

                    <div class="row profile-row">
                        <div class="col-12">
                            <label class="profile-input-row">
                                <div class="input-desc">
                                    Veebileht
                                </div>
                                <input type="text" value="{{ $company->website }}" name="website">
                            </label>
                        </div>
                    </div>

                    <div class="row profile-row">
                        <div class="col-12">
                            <label class="profile-input-row">
                                <div class="input-desc">
                                    E-maili aadress
                                </div>
                                <input type="email" value="{{ $company->email }}" name="email">
                            </label>
                        </div>
                    </div>

                    <div class="row profile-row">
                        <div class="col-12">
                            <label class="profile-input-row">
                                <div class="input-desc">
                                    Kontakttelefon
                                </div>
                                <input type="text" value="{{ $company->phone }}" name="phone">
                            </label>
                        </div>
                    </div>





                    @if(false)
                    <div class="row profile-row">
                        <div class="col-12">
                            <label class="profile-input-row">
                                <div class="input-desc">
                                    Reg nr
                                </div>
                                <input type="text" value="{{ $company->reg_number }}" name="reg_number">
                            </label>
                        </div>
                    </div>
                    @endif

                    <div class="row profile-row">
                        <div class="col-12">
                            <label class="profile-input-row">
                                <div class="input-desc">
                                    Bränd
                                </div>
                                <input type="text" value="{{ $company->brand }}" name="brand">
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

                <div class="col-12 col-md-6">
                    @if(false)
                    <div class="row profile-row">
                        <div class="col-12">
                            <label class="profile-input-row">
                                <div class="input-desc">
                                    Maakond
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
                                    Linn
                                </div>
                                <input type="text" value="{{ $company->city }}" name="city">
                            </label>
                        </div>
                    </div>

                    @endif

                    @if(false)

                    <div class="row profile-row">
                        <div class="col-12">
                            <label class="profile-input-row">
                                <div class="input-desc">
                                    Postiindeks
                                </div>
                                <input type="text" value="{{ $company->postal }}" name="postal">
                            </label>
                        </div>
                    </div>

                    @endif


                </div>

            </div>




        </div>


    </form>
</div>  

@endsection
