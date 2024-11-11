<?php

namespace App\Http\Controllers;

use App\Enums\SearchSlugEnum;
use App\Models\Article;
use App\Models\Company;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseType;
use App\Models\Event;
use App\Models\ExtraService;
use App\Models\Property;
use App\Models\PropertyRegion;
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
        'articles' => Article::class,
        'courses' => Course::class,
        'companies' => Company::class,
        'properties' => Property::class,
    ];

    public static $titles = [
        'articles' => 'title',
        'courses' => 'title',
        'companies' => 'name',
        'properties' => 'name',
    ];


    /**
     * @param string|null $type
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function search(Request $request, string $type = null)
    {
        $type = $type === null ? null : SearchSlugEnum::from($type)->getNotLocalizedValue();

        $searchQuery = $request->get('search');
        $selectedCourseType = $request->query('course_type');

        $companiesClosure = function (Builder $query) use ($searchQuery) {
            return $query
                ->orWhere('brand', 'like', "%{$searchQuery}%")
                ->orWhereHas('tags', function (Builder $query) use ($searchQuery) {
                    return $query->when($searchQuery !== null, function (Builder $query) use ($searchQuery) {
                        return $query->where('text', 'LIKE', "%$searchQuery%");
                    });
                })
                ->active();
        };

        $coursesClosure = function (Builder $query) use ($request, $type, $searchQuery) {
            return $query
                ->featuredOrder();
        };

        $types = CourseType::query()->where('show_on_search_page', true)->orderBy('sort_order', 'ASC')->get();

        $counterTypes = $types->toBase()->merge(static::$types);
        $counters = [];
        foreach ($counterTypes as $keyType => $model) {
            if ($keyType === 'courses') {
                continue;
            }

            if ($model instanceof CourseType) {
                $counters["courses/{$model->getKey()}"] = Course::query()
                    ->when($searchQuery !== null, function (Builder $query) use ($searchQuery, $type) {
                        return $query->where(function (Builder $query) use ($searchQuery) {
                            return $query->where('title', 'LIKE', "%{$searchQuery}%")
                                ->orWhereHas('courseCategories', function (Builder $builder) use ($searchQuery) {
                                    return $builder->where('title', 'like', "%{$searchQuery}%");
                                });
                        });
                    })
                    ->where($coursesClosure)
                    ->where('course_type_id', $model->getKey())
                    ->count();

                continue;
            }

            $counters[$keyType] = app($model)->newQuery()
                ->when($searchQuery !== null, function (Builder $query) use ($searchQuery, $keyType) {
                    return $query->where(static::$titles[$keyType], 'LIKE', "%{$searchQuery}%");
                })
                ->when($keyType === 'companies', $companiesClosure)
                ->count();

        }

        $max = array_keys($counters, max($counters));

        if ($type === null) {
            $maxKey = $max[0];
            $type = $counters[$maxKey] > 0 ? $max[0] : 'companies';

            if (str_contains($type, '/')) {
                [$type, $meta] = explode('/', $type);

                if ($type === 'courses') {
                    $selectedCourseType = $meta;
                }
            }
        }

        /** @var Model $model */
        $model = app($this->getModelFromType($type));

        $result = $model->newQuery()
            ->when($searchQuery !== null, function (Builder $query) use ($searchQuery, $type) {
                if ($type === 'courses') {
                    return $query->where(function (Builder $query) use ($searchQuery) {
                        return $query->where('title', 'LIKE', "%{$searchQuery}%")
                            ->orWhereHas('courseCategories', function (Builder $builder) use ($searchQuery) {
                                return $builder->where('title', 'like', "%{$searchQuery}%");
                            });
                    });
                }

                return $query->where(static::$titles[$type], 'LIKE', "%{$searchQuery}%");
            })
            ->when($type === 'companies', $companiesClosure)
            ->when($type === 'courses', $coursesClosure);

        if ($type === 'courses') {
            $result = $result
                ->where('course_type_id', $selectedCourseType);
        }

        if ($type === 'properties') {
            $result = $result
                ->where('active', '1');
        }

        $result = $result->paginate();

        if ($type === 'properties' && $result->count() === 1) {
            $property = $result->items()[0];

            return redirect()->to(route('properties.show', ['slug' => $property->slug]));
        }

        dd($result);

        if (
            collect($counters)->sum() === 1 && ($resource = $result->items()[0])
            && !in_array($type, ['courses', 'properties'])
        ) {
            return redirect()->to(route("{$type}.show", $resource));
        }

        return view('search', compact('result', 'type', 'counters', 'searchQuery', 'types', 'selectedCourseType'));
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
            ->active()
            ->ordered()
            ->paginate(16);

        return view('companies.index', compact('companies'));
    }

    public function company(Company $company, Request $request)
    {
        $selectedCourseType = $request->get('type');


        views($company)->record();

        $closure = function ($type) use ($selectedCourseType) {
            return function (Builder $query) use ($selectedCourseType) {
                return $query
                    ->when($selectedCourseType !== null, function ($query) use ($selectedCourseType) {
                        return $query->where('course_type_id', $selectedCourseType);
                    });
            };
        };

        $types = CourseType::query()->orderBy('sort_order', 'ASC')->get();

        $counts = [];
        foreach ($types as $type) {
            $counts[$type->getKey()] = $company->courses()
                ->where('course_type_id', $type->getKey())
                ->featuredOrder()
                ->count();
        }

        $max = array_keys($counts, max($counts));

        $maxCourseType = $max[0];

        if (!$request->has('type')) {
            return redirect(route('companies.show', ['company' => $company, 'type' => $maxCourseType]));
        }


        $courses = $company->courses()
            ->where($closure($request->get('type', 'live')))
            ->featuredOrder()
            ->paginate()
            ->fragment('calendar');


        return view('companies.single', compact('types', 'company', 'courses', 'counts', 'selectedCourseType'));

    }

    public function articles(Request $request)
    {
        $articles = Article::whereDate('published_at', '>=', Carbon::now())->orderBy('id', 'DESC')->get();

        return view('articles', compact('articles'));
    }

    public function home(Request $request)
    {
        $popularCourses = Course::query()->orderByUniqueViews()->limit(13)->get();

        /** @var Collection $courses */
        $courses = \App\Models\Course::query()
            ->featuredOrder()
            ->limit(15)
            ->get();

        $articles = \App\Models\Article::whereDate('published_at', '>=', Carbon::now())->orderBy('id', 'DESC')->take(3)->get();

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
        $regions = PropertyRegion::all();
        $services = ExtraService::all();

        $properties = Property::query()->where('active', '1')->orderBy('sort_order', 'ASC');


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


    public function property(Request $request)
    {
        $regions = PropertyRegion::all();
        $services = ExtraService::all();

        $properties = Property::query()->where('active', '1')->where('slug', $request->slug);


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

        return view('properties.index', compact('services', 'regions', 'properties'));

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
