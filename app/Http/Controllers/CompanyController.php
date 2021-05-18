<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\UpdateRequest;
use App\Http\Requests\StoreCourseRequest;
use App\Models\Company;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        return view('admin.login');
    }


    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email'
            ],
            'password' => [
                'required'
            ]
        ]);

        $email = $request->get('email');
        $password = $request->get('password');


        if (Auth::guard('company')->attempt(['email' => $email, 'password' => $password], true)) {
//            $request->session()->regenerate();

            return redirect()->to('/company/profile');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function profile(Request $request)
    {
        $company = $request->user();

        $regions = Region::all();

        return view('admin.profile', compact('company', 'regions'));
    }

    public function update(UpdateRequest $request)
    {
        /** @var Company $company */
        $company = $request->user();

        $company->update($request->validated());

        if ($request->has('cover')) {
            $company->addMediaFromRequest('cover')->toMediaCollection('cover');
        }

        return redirect()->back()
            ->with('success', 'Company updated');
    }

    public function statistics(Request $request)
    {
        /** @var Company $company */
        $company = $request->user();

        $views = DB::table('views')
            ->where('viewable_type', Company::class)
            ->where('viewable_id', $company->getKey())
            ->select(DB::raw('count(*) as `views`'), DB::raw("DATE_FORMAT(viewed_at, '%Y-%m') date"))
            ->groupby('date')
            ->get()
            ->sortByDesc(function ($item) {
                $year = explode('-', $item->date);

                return $year[0];
            })
            ->groupBy(function ($item) {
                $year = explode('-', $item->date);

                return $year[0];
            });

        return view('admin.statistics', compact('views'));
    }

    public function description(Request $request)
    {
        /** @var Company $company */
        $company = $request->user();

        return view('admin.description', compact('company'));
    }

    public function logout(Request $request)
    {
        auth()->logout();

        return redirect()->to('/');
    }

    public function mycourses(Request $request)
    {
        /** @var Company $user */
        $user = $request->user();

        $categories = CourseCategory::query()->with('children')->get();
        $regions = Region::query()->get();

        $courses = $user->courses()
            ->when($request->get('type') === 'orderable', function ($query) {
                return $query->whereNull('started_at');
            }, function ($query) {
                return $query->whereNotNull('started_at');
            })
            ->paginate();

        return view('admin.mycourses', compact('categories', 'regions', 'courses'));
    }

    public function createCourse(Request $request)
    {
        $categories = CourseCategory::query()->with('children')->get()->keyBy('id');
        $regions = Region::query()->get()->keyBy('id');


        $course = null;

        return view('admin.courses.create', compact('categories', 'regions', 'course'));
    }

    public function editCourse(Course $course)
    {
        $categories = CourseCategory::query()->with('children')->get()->keyBy('id');
        $regions = Region::query()->get()->keyBy('id');

        return view('admin.courses.edit', compact('categories', 'regions', 'course'));
    }

    public function modifyCourse(Request $r)
    {
        $action = $r->action;
        $id = $r->course;
        $course = Course::where('id', $id)->first();
        if($action == 'clone') {
            $newCourse = new Course;
            $newCourse->title = $course->title;
            $newCourse->price = $course->price;
            $newCourse->featuring_ended_at = $course->featuring_ended_at;
            $newCourse->duration_minutes = $course->duration_minutes;
            $newCourse->started_at = $course->started_at;
            $newCourse->ended_at = $course->ended_at;
            $newCourse->company_id = $course->company_id;
            $newCourse->region_id = $course->region_id;
            $newCourse->url = $course->url;
            $newCourse->save();
        }
        if($action == 'delete') {
            $course->delete();
        }

        return redirect()->back();
    }


    public function storeCourse(StoreCourseRequest $request)
    {
        /** @var Company $company */
        $company = $request->user();
        /** @var Course $course */
        $course = Course::query()->make($request->validated());

        $company->courses()->save($course);

        $course->courseCategories()->sync($request->get('categories'));

        return redirect()->route('profile');
    }

    public function updateCourse(Course $course, StoreCourseRequest $request)
    {
        $course->fill($request->validated());

        $course->courseCategories()->sync($request->get('categories'));

        $course->save();

        return redirect()->route('profile');
    }

}
