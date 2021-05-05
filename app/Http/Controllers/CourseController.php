<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = CourseCategory::query()->whereNull('course_category_id')->with('children')->get();

        $selectedCategory = $request->has('category') ? CourseCategory::query()->find($request->get('category')) : null;
        $selectedRegion = $request->has('region') ? Region::query()->find($request->get('region')) : null;
        $selectedStartedAt = $request->get('started_at') ? Carbon::parse($request->get('started_at')) : null;

        $regions = Region::query()->get();

        $courses = \App\Models\Course::query()
            ->when($selectedCategory, function ($query, $selectedCategory) {
                return $query->where('course_category_id', $selectedCategory->getKey());
            })
            ->when($selectedRegion, function ($query, $selectedRegion) {
                return $query->where('region_id', $selectedRegion->getKey());
            })
            ->when($selectedStartedAt, function ($query, $selectedStartedAt) {
                return $query->where('started_at', '>=', $selectedStartedAt);
            })
            ->whereDate('ended_at', '<', now())
            ->ordered()
            ->paginate();

        return view('courses.index', compact('categories', 'selectedCategory', 'regions', 'selectedRegion', 'courses'));
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param Course $course
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Course $course)
    {
        return view('course.show', compact('course'));
    }

}
