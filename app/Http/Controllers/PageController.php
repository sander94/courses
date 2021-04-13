<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return view('search');
    }

    public function courses(Request $request)
    {
        $categories = CourseCategory::query()->whereNull('course_category_id')->with('children')->get();

        $selectedCategory = $request->has('category') ? CourseCategory::query()->find($request->get('category')) : null;
        $selectedRegion = $request->has('region') ? Region::query()->find($request->get('region')) : null;
        $selectedStartedAt = $request->has('started_at') ? Carbon::parse($request->get('started_at')) : null;

        $regions = Region::query()->get();

        $courses = Course::query()
            ->when($selectedCategory, function ($query, $selectedCategory) {
                return $query->where('course_category_id', $selectedCategory->getKey());
            })
            ->when($selectedRegion, function ($query, $selectedRegion) {
                return $query->where('region_id', $selectedRegion->getKey());
            })
            ->when($selectedStartedAt, function ($query, $selectedStartedAt) {
                return $query->where('started_at', '>=', $selectedStartedAt);
            })
            ->paginate();

        return view('courses', compact('categories', 'selectedCategory', 'regions', 'selectedRegion', 'courses'));
    }

    public function articles(Request $request)
    {
        $articles = Article::query()->paginate();

        return view('articles', compact('articles'));
    }
}
