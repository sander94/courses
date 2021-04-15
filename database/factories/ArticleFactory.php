<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Article;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'content' => $this->faker->paragraphs(3, true),
            'published_at' => $this->faker->dateTime(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Article $article) {
            $article->addMediaFromUrl($this->faker->imageUrl())->toMediaCollection('cover');

            for ($i = 1; $i <= 5; $i++) {
                $article->addMediaFromUrl($this->faker->imageUrl())->toMediaCollection('gallery');
            }
        });
    }
}
