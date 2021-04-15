<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Event;
use App\Models\Region;
use Carbon\Carbon;
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

    public function articles(Request $request)
    {
        $articles = Article::query()->paginate();

        return view('articles', compact('articles'));
    }

    private function getModelFromType(string $type)
    {
        return static::$types[$type];
    }
}
