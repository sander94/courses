<div class="content">
    <div class="row">
        <div class="col-12 admin-menu mb-5">
            <a href="{{ route('profile') }}" class="{{ Route::is('profile') ? 'active' : '' }}">My profile</a>
            <a href="{{ route('description') }}" class="{{ Route::is('description') ? 'active' : '' }}">Additional information</a>
            <a href="#">Tags</a>
            <a href="{{ route('statistics') }}" class="{{ Route::is('statistics') ? 'active' : '' }}">Statistics</a>
            <a href="{{ route('mycourses') }}" class="{{ Route::is('mycourses') ? 'active' : '' }}">My courses</a>
        </div>

    </div>
</div>