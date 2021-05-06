@extends('layouts/web')

@section('content')

    @include('partials.admin.submenu')
<style>
.multiselect__tags {
    background: transparent;
    border-radius: 30px;
}
.multiselect__tags input[type='text'] {
    border: 0;
}
.multiselect {
    width: 60%;
    border: 2px solid #969696;
    border-radius: 30px;
}
.mx-datepicker {
    width: 60%;
}
.profile-input-row input[type="text"].mx-input {
    width: 100%;
}
</style>
    <div class="content" id="form">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <form action="{{ route('profile.store_course') }}" method="POST">
            @csrf
            <input type="hidden" name="course_category_id" :value="model.category.id" v-if="model.category">
            <input type="hidden" name="region_id" :value="model.region.id" v-if="model.region">
            <input type="hidden" name="started_at" :value="model.started_at" v-if="model.started_at">
            <input type="hidden" name="ended_at" :value="model.ended_at" v-if="model.ended_at">
          
            <div class="row">
                <div class="col-12">
                    <h2>Lisa uus koolitus</h2>
                </div>
            </div>



            <div class="row profile-row">
                <div class="col-6">
                    <label class="profile-input-row">
                        <div class="input-desc">
                            Koolituse nimi
                        </div>
                        <input type="text" value="{{ old('title') }}" name="title">
                    </label>
                </div>
            </div>

            <div class="row profile-row">
                <div class="col-6">
                    <div class="profile-input-row">
                        <div class="input-desc">
                            Vali kategooria
                        </div>
                        <multiselect :options="categories" v-model="model.category" label="title"></multiselect>
                    </div>
                </div>
            </div>

            <div class="row profile-row">
                <div class="col-6">
                    <label class="profile-input-row">
                        <div class="input-desc">
                            <label for="is_buyable">Tellitav kursus?</label>
                        </div>
                        <input type="checkbox" id="is_buyable" name="is_buyable" v-model="model.is_buyable">
                    </label>
                </div>
            </div>

            <div class="row profile-row" v-if="!model.is_buyable">
                <div class="col-6">
                    <label class="profile-input-row">
                        <div class="input-desc">
                            <label for="is_buyable">Algusaeg</label>
                        </div>
                        <datepicker v-model="model.started_at" type="date" value-type="format"></datepicker>
                    </label>
                </div>
            </div>

            <div class="row profile-row" v-if="!model.is_buyable">
                <div class="col-6">
                    <label class="profile-input-row">
                        <div class="input-desc">
                            <label for="is_buyable">Lõppaeg</label>
                        </div>
                        <datepicker v-model="model.ended_at" type="date" value-type="format"></datepicker>
                    </label>
                </div>
            </div>


            <div class="row profile-row">
                <div class="col-6">
                    <div class="profile-input-row">
                        <div class="input-desc">
                            Asukoht
                        </div>
                        <multiselect :options="regions" v-model="model.region" label="title"></multiselect>
                    </div>
                </div>
            </div>

            <div class="row profile-row">
                <div class="col-6">
                    <label class="profile-input-row">
                        <div class="input-desc">
                            Hind:
                        </div>
                        <input type="text" name="price" value="{{ old('price') }}">
                    </label>
                </div>
            </div>

            <div class="row profile-row">
                <div class="col-6">
                    <label class="profile-input-row">
                        <div class="input-desc">
                            Link kursusele
                        </div>
                        <input type="text" name="url" value="{{ old('url') }}">
                    </label>
                </div>
            </div>

            <div class="row profile-row">
                <div class="col-6">
                    <label class="profile-input-row">
                        <div class="input-desc">
                            Telefon
                        </div>
                        <input type="text" name="phone" value="{{ old('phone') }}">
                    </label>
                </div>
            </div>

            <div class="row profile-row">
                <div class="col-6">
                    <label class="profile-input-row">
                        <div class="input-desc">
                            E-mail:
                        </div>
                        <input type="text" name="email" value="{{ old('email') ?? Auth::user()->email }}">
                    </label>
                </div>
            </div>



                <div class="row mt-3">
                    <div class="col-12">
                        <button type="submit" name="submit" class="submit">SALVESTA</button>
                    </div>
                </div>
            </div>

        </form>

    </div>

@endsection

@push('js')
    <script>
        new Vue({
            el: '#form',

            data() {
                return {
                    model: {
                        is_buyable: @json(old('is_buyable') ?? false),
                        category: null,
                        region: null,
                        started_at: @json(old('started_at')),
                        ended_at: @json(old('ended_at'))
                    },
                    regions: @json($regions),
                    categories: @json($categories)
                }
            }
        })
    </script>
@endpush
