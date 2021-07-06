<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Company;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Event;
use App\Models\ExtraService;
use App\Models\Property;
use App\Models\Region;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public static $types = [
        'courses' => Course::class,
        'articles' => Article::class,
        'companies' => Company::class,
        'properties' => Property::class,
    ];

    public static $titles = [
        'courses' => 'title',
        'articles' => 'title',
        'companies' => 'name',
        'properties' => 'name',
    ];

    /**
     * @param string $type
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(string $type = 'courses', Request $request)
    {
        /** @var Model $model */
        $model = app($this->getModelFroMType($type));

        $searchQuery = $request->get('search');

        $result = $model->newQuery()
            ->where(static::$titles[$type], 'LIKE', "{$searchQuery}%")
            ->when($type === 'companies', function (Builder $query) use ($searchQuery) {
                return $query
                    ->orWhere('brand', 'like', "%{$searchQuery}%")
                    ->orWhereHas('tags', function (Builder $query) use ($searchQuery) {
                        return $query->where('text', 'LIKE', "%$searchQuery%");
                    });
            })
            ->when($type === 'courses', function (Builder $query) {
                return $query->featuredOrder();
            })
            ->paginate();


        $counters[$type] = $result->total();
        foreach (static::$types as $keyType => $model) {
            if ($keyType !== $type) {
                $counters[$keyType] = app($model)->newQuery()
                    ->where(static::$titles[$keyType], 'LIKE', "{$searchQuery}%")
                    ->when($keyType === 'companies', function (Builder $query) use ($searchQuery) {
                        return $query
                            ->orWhere('brand', 'like', "%{$searchQuery}%")
                            ->orWhereHas('tags', function (Builder $query) use ($searchQuery) {
                                return $query->where('text', 'LIKE', "%$searchQuery%");
                            });
                    })
                    ->count();
            }
        }


        return view('search', compact('result', 'type', 'counters', 'searchQuery'));
    }

    public function courses(Request $request)
    {

    }

    public function companies(Request $request)
    {
        $companies = Company::orderBy('sort_order', 'DESC')
            ->when($request->get('search'), function (Builder $query, $search) {
                return $query
                    ->where('name', 'like', "%$search%")
                    ->orWhere('brand', 'like', "%$search%")
                    ->orWhereHas('tags', function (Builder $query) use ($search) {
                        return $query->where('text', 'LIKE', "%$search%");
                    });
            })
            ->ordered()
            ->paginate(16);

        return view('companies.index', compact('companies'));
    }

    public function company(Company $company, Request $request)
    {
        views($company)->record();

        $courses = $company->courses()
            ->where(function (Builder $query) {
                return $query
                    ->where(function (Builder $query) {
                        return $query->whereNotNull('featuring_ended_at')
                            ->whereNull('started_at');
                    })
                    ->orWhere(function (Builder $query) {
                        return $query->whereDate('ended_at', '>', now())
                            ->whereNotNull('started_at');
                    });
            })
            ->when($request->get('type') === 'orderable', function ($query) {
                return $query->whereNull('started_at');
            }, function ($query) {
                return $query->whereNotNull('started_at');
            })
            ->featuredOrder()
            ->paginate();

        return view('companies.single', compact('company', 'courses'));
    }

    public function articles(Request $request)
    {
        $articles = Article::query()->paginate();

        return view('articles', compact('articles'));
    }

    public function home(Request $request)
    {
        $popularCourses = Course::query()->orderByUniqueViews()->limit(13)->get();

        /** @var Collection $courses */
        $courses = \App\Models\Course::query()
            ->where(function (Builder $query) {
                return $query
                    ->where(function (Builder $query) {
                        return $query->whereNotNull('featuring_ended_at')
                            ->whereNull('started_at');
                    })
                    ->orWhere(function (Builder $query) {
                        return $query->whereDate('ended_at', '>', now())
                            ->whereNotNull('started_at');
                    });
            })
            ->featuredOrder()
            ->limit(15)
            ->get();

        $articles = \App\Models\Article::orderBy('id', 'ASC')->take(3)->get();

        return view('home')->with([
            'courses' => $courses,
            'articles' => $articles,
            'popularCourses' => $popularCourses
        ]);

    }

    public function contact(Request $request)
    {

        return view('contact');

    }

    public function rooms(Request $request)
    {
        $regions = Region::all();
        $services = ExtraService::all();

        $properties = Property::query();


        $properties = $properties
            ->when($request->get('services'), function (Builder $query, $services) {
                return $query->whereHas('services', function (Builder $query) use ($services) {
                    return $query->whereIn('id', $services);
                });
            })
            ->when($request->get('capacity'), function (Builder $query, $capacity) {
                return $query->whereHas('rooms', function (Builder $query) use ($capacity) {

                    foreach (array_keys($capacity) as $column) {
                        $query = $query->where($column, '>', 0);
                    }

                    return $query;
                });
            })
            ->when($request->get('region'), function (Builder $query, $region) {
                return $query->where('property_region_id', $region);
            });

        $properties = $properties->with(['rooms', 'services'])->paginate(5);
        return view('rooms.index', compact('services', 'regions', 'properties'));

    }

    private function getModelFromType(string $type)
    {
        return static::$types[$type];
    }

    public function trackCourse(Course $course)
    {
        views($course)->record();

        return redirect()->to($course->url);
    }

    public function trackCompany(Company $company)
    {
        views($company)->record();

        return redirect()->to($company->website);
    }
}
