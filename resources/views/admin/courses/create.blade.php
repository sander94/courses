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
        .profile-input-row input[name="date"] {
            padding: 20px 15px;
        }
    </style>


    <div class="content p-3">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <form action="{{ route('profile.store_course') }}" method="POST" id="form">
            @include('admin.courses.form')
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
                        categories: @json(old('categories') ?? []),
                        region: @json(old('region') ?? null),
                        started_at: @json(old('started_at') ?? null),
                        ended_at: @json(old('ended_at') ?? null)
                    },
                    regions: @json($regions),
                    categories: @json($categories)
                }
            },

            computed: {
                regionOptions() {
                    return Object.values(this.regions).map(item => item.id)
                },
                categoryOptions() {
                    return Object.values(this.categories).map(item => item.id)
                },
            },

            methods: {
                customRegionLabel(id) {
                    return this.regions[id].title
                },
                customCategoryLabel(id) {
                    return this.categories[id].title
                },
            }
        })
    </script>
@endpush
