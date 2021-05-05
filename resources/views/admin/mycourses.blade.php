@extends('layouts/web')

@section('content')

    @include('partials.admin.submenu')

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
                <div class="col-12 mb-3">
                    <input type="text" name="title" placeholder="Course title" value="{{ old('title') }}">
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <h2>Choose categories</h2>
                    <multiselect :options="categories" v-model="model.category" label="title"></multiselect>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        Starts at:
                        <datepicker v-model="model.started_at" type="datetime" value-type="format"></datepicker>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        Ends at:
                        <datepicker v-model="model.ended_at" type="datetime" value-type="format"></datepicker>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        Region:
                        <multiselect :options="regions" v-model="model.region" label="title"></multiselect>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        Price: <input type="text" name="price" value="{{ old('price') }}">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        Registration URL: <input type="text" name="url" value="{{ old('url') }}">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        Phone: <input type="text" name="phone" value="{{ old('phone') }}">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        E-mail: <input type="text" name="email" value="{{ old('email') ?? Auth::user()->email }}">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <button type="submit" name="submit">Submit</button>
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
