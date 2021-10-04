<div class="content">
    <div class="row">
        <div class="col-12 admin-menu mb-5">
            <a href="{{ route('profile') }}" class="{{ Route::is('profile') ? 'active' : '' }}">Minu ettevõte</a>
            <a href="{{ route('description') }}" class="{{ Route::is('description') ? 'active' : '' }}">Lisainformatsioon</a>
            <!-- <a href="#">Tags</a> -->
            <a href="{{ route('statistics') }}" class="{{ Route::is('statistics') ? 'active' : '' }}">Statistika</a>
            <a href="{{ route('mycourses') }}?type=3" class="{{ (Route::is('mycourses') || Route::is('createCourse')) ? 'active' : '' }}">Minu koolitused</a>
        </div>

    </div>
</div>