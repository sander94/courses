<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Company;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Event;
use App\Models\Region;
use App\Models\User;
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
    ];

    public static $titles = [
        'courses' => 'title',
        'articles' => 'title',
        'companies' => 'name',
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
            ->paginate();

        $counters[$type] = $result->total();
        foreach (static::$types as $keyType => $model) {
            if ($keyType !== $type) {
                $counters[$keyType] = app($model)->newQuery()->where(static::$titles[$keyType], 'LIKE', "{$searchQuery}%")->count();
            }
        }

        return view('search', compact('result', 'type', 'counters', 'searchQuery'));
    }

    public function courses(Request $request)
    {

    }

    public function companies(Request $request)
    {
        $companies = Company::query()
            ->when($request->get('search'), function (Builder $query, $search) {
                return $query->where('name', 'like', "%$search%");
            })
            ->ordered()
            ->paginate();

        return view('companies.index', compact('companies'));
    }

    public function company(Company $company, Request $request)
    {
        views($company)->record();

        $courses = $company->courses()
            ->when($request->get('type') === 'orderable', function ($query) {
                return $query->whereNull('started_at');
            }, function ($query) {
                return $query->whereNotNull('started_at');
            })
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

        $courses = \App\Models\Course::query()->ordered()
            ->limit(15)->get();

        $articles = \App\Models\Article::orderBy('id', 'desc')->take(3)->get();

        return view('home')->with([
            'courses' => $courses,
            'articles' => $articles,
            'popularCourses' => $popularCourses
        ]);

    }

    function contact(Request $request)
    {

        return view('contact');

    }

    function rooms(Request $request)
    {

        return view('rooms.index');

    }

    private function getModelFromType(string $type)
    {
        return static::$types[$type];
    }
}
