<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\UpdateRequest;
use App\Http\Requests\StoreCourseRequest;
use App\Models\Company;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseType;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\CompanyUpdatesInfo;
use App\Mail\CompanyUpdatesProfile;
use App\Mail\CompanyAddsCourse;


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
            'username' => [
                'required',
            ],
            'password' => [
                'required'
            ]
        ]);

        $username = $request->get('username');
        $password = $request->get('password');


        if (Auth::guard('company')->attempt(['username' => $username, 'password' => $password], true)) {

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

        $company->update($request->all());

        if ($request->has('cover')) {
            $company->addMediaFromRequest('cover')->toMediaCollection('cover');
        }
    
        Mail::to('info@koolitused.ee')->send(new CompanyUpdatesInfo($company->name));

        return redirect()->back()
            ->with('success', 'Company updated');
    }


 public function profileUpdate(Request $r)
    {
      
      if(!$r->description) {
          $company = Company::where('id', Auth::user()->id)->first();
          $company->name = $r->name;
          $company->city = $r->city;
          $company->website = $r->website;
          $company->email = $r->email;
          $company->phone = $r->phone;
          $company->brand = $r->brand;
            if ($r->has('cover')) {
                $company->addMediaFromRequest('cover')->toMediaCollection('cover');
            }
          $company->save();

          Mail::to('info@koolitused.ee')->send(new CompanyUpdatesProfile($company->name));
        }

        else {
        $company = Company::where('id', Auth::user()->id)->first();
        $company->description = $r->description;
        $company->save();

        Mail::to('info@koolitused.ee')->send(new CompanyUpdatesInfo($company->name));

        }

      return redirect()->back();

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

        if($request->type == '3') {
            $courses = $user->courses()->where('course_type_id', '3')->where('started_at', '>=', Carbon::now())->orderBy('started_at', 'ASC')->paginate();
        }
        else {
        $courses = $user->courses()
            ->when($request->has('type'), function ($query) use ($request) {
                return $query->where('course_type_id', $request->get('type'));
            })
            ->paginate();
        }

        $types = CourseType::query()->orderBy('sort_order', 'ASC')->get();


        return view('admin.mycourses', compact('categories', 'regions', 'courses', 'types'));
    }

    public function createCourse(Request $request)
    {
        $categories = CourseCategory::query()->with('children')->get()->keyBy('id');
        $regions = Region::query()->get()->keyBy('id');


        $course = null;

        $coursetypes = CourseType::orderBy('sort_order', 'ASC')->get();

        return view('admin.courses.create', compact('categories', 'regions', 'course', 'coursetypes'));
    }

    public function editCourse(Course $course)
    {
        $categories = CourseCategory::query()->with('children')->get()->keyBy('id');
        $regions = Region::query()->get()->keyBy('id');

        $coursetypes = CourseType::get();

        return view('admin.courses.edit', compact('categories', 'regions', 'course', 'coursetypes'));
    }

    public function modifyCourse(Request $r)
    {
        $action = $r->action;
        $id = $r->course;
        $course = Course::where('id', $id)->first();
        if ($action == 'clone') {
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
            $newCourse->course_type_id = $course->course_type_id;
            $newCourse->save();
        }
        if ($action == 'delete') {
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

        $type = $course->course_type_id;

        Mail::to('info@koolitused.ee')->send(new CompanyAddsCourse($company->name));

        return redirect()->route('mycourses', ['type'=>$type]);
    }

    public function updateCourse(Course $course, StoreCourseRequest $request)
    {
        $course->fill($request->validated());

        $course->courseCategories()->sync($request->get('categories'));

        $course->save();

        $type = $course->course_type_id;

        return redirect()->route('mycourses', ['type'=>$type]);
    }

}
