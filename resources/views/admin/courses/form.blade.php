@csrf

<input type="hidden" name="categories[]" :value="category" v-for="category in model.categories">

<input type="hidden" name="region_id" :value="model.region" v-if="model.region">
<input type="hidden" name="started_at" :value="model.started_at" v-if="model.started_at">
<input type="hidden" name="ended_at" :value="model.ended_at" v-if="model.ended_at">


<div class="row">
    <div class="col-12">
        @isset($course->title) <h2>Muuda koolitust</h2> @else <h2>Lisa uus koolitus</h2> @endif
    </div>
</div>


<div class="row profile-row">
    <div class="col-6">
        <div class="profile-input-row">
            <div class="input-desc">
                Koolituse tüüp
            </div>
            <select name="course_type_id" onchange="checkIfHide(this);">
                @foreach($coursetypes as $coursetype)
                    <option value="{{ $coursetype->id }}" @isset($course->course_type_id) @if($coursetype->id == $course->course_type_id) selected @endif @endisset>{{ $coursetype->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>



<div class="row profile-row">
    <div class="col-6">
        <label class="profile-input-row">
            <div class="input-desc">
                Koolituse nimi
            </div>
            <input type="text" value="{{ old('title') ?? optional($course)->title }}" name="title">
        </label>
    </div>
</div>

<div class="row profile-row">
    <div class="col-6">
        <div class="profile-input-row">
            <div class="input-desc">
                Vali kategooria
            </div>
            <multiselect :options="categoryOptions" :custom-label="customCategoryLabel" :multiple="true"
                         v-model="model.categories"
                         label="title"></multiselect>
        </div>
    </div>
</div>

<div id="datefields">
<div class="row profile-row">
    <div class="col-6">
        <label class="profile-input-row">
            <div class="input-desc">
                <label for="is_buyable">Algusaeg</label>
            </div>
            <datepicker v-model="model.started_at" type="date" value-type="format"></datepicker>
        </label>
    </div>
</div>

<div class="row profile-row">
    <div class="col-6">
        <label class="profile-input-row">
            <div class="input-desc">
                <label for="is_buyable">Lõppaeg</label>
            </div>
            <datepicker v-model="model.ended_at" type="date" value-type="format"></datepicker>
        </label>
    </div>
</div>
</div>
<!-- 
<div class="row profile-row">
    <div class="col-6">
        <label class="profile-input-row">
            <div class="input-desc">
                Kestus minutites
            </div>
            <input type="number" value="{{ old('duration_minutes') ?? optional($course)->duration_minutes }}" name="duration_minutes" placeholder="">
        </label>
    </div>
</div>
-->
<div class="row profile-row">
    <div class="col-6">
        <div class="profile-input-row">
            <div class="input-desc">
                Asukoht
            </div>
            <multiselect :options="regionOptions" :custom-label="customRegionLabel"  v-model="model.region" label="title"></multiselect>
        </div>
    </div>
</div>

<div class="row profile-row">
    <div class="col-6">
        <label class="profile-input-row">
            <div class="input-desc">
                Hind
            </div>
            <input type="text" name="price" value="{{ old('price') ?? optional($course)->price }}">
        </label>
    </div>
</div>

<div class="row profile-row">
    <div class="col-6">
        <label class="profile-input-row">
            <div class="input-desc">
                Link kursusele
            </div>
            <input type="text" name="url" value="{{ old('url') ?? optional($course)->url }}">
        </label>
    </div>
</div>

<div class="row profile-row">
    <div class="col-6">
        <label class="profile-input-row">
            <div class="input-desc">
                E-mail:
            </div>
            <input type="text" name="email"
                   value="{{ old('email') ?? optional($course)->email ?? Auth::user()->email }}">
        </label>
    </div>
</div>


<div class="row mt-3">
    <div class="col-12">
        <button type="submit" name="submit" class="submit">SALVESTA</button>
    </div>
</div>
</div>


<script>

function checkIfHide(select) {
     var value = select.options[select.selectedIndex].value;

     if(value == 3) {
        $('#datefields').show();
     }
     else {
        $('#datefields').hide();
     }
}

</script>
