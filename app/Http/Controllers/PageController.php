<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Company;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Event;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public static $types = [
        'courses' => Course::class,
        'articles' => Article::class
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
            ->where('title', 'LIKE', "{$searchQuery}%")
            ->paginate();

        $counters[$type] = $result->total();
        foreach (static::$types as $keyType => $model) {
            if ($keyType !== $type) {
                $counters[$keyType] = app($model)->newQuery()->where('title', 'LIKE', "{$searchQuery}%")->count();
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
            ->paginate();

        return view('companies.index', compact('companies'));
    }

    public function company(Company $company, Request $request)
    {
        views($company)->record();

        $courses = $company->courses()->paginate();

        return view('companies.single', compact('company', 'courses'));
    }

    public function articles(Request $request)
    {
        $articles = Article::query()->paginate();

        return view('articles', compact('articles'));
    }

    public function home(Request $request) {

        $courses = \App\Models\Course::get();
        // TODO: Show only 15 courses here. 3 courses that are LOCKED in place, in top.

        $articles = \App\Models\Article::orderBy('id', 'desc')->take(3)->get();

        return view('home')->with([
            'courses' => $courses,
            'articles' => $articles
            ]);

    }

    function contact(Request $request) {

        return view('contact');

    }

    private function getModelFromType(string $type)
    {
        return static::$types[$type];
    }
}
