<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Posts;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PostsFactory extends Factory
{
    /**
     * The name of the corresponding model.
     *
     * @var string
     */
    protected $model = Posts::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'excerpt' => $this->faker->text(50),
            'image' => $this->faker->imageUrl(800, 600, 'posts', true, 'Post'),
            'author' => $this->faker->userName,
            'views' => $this->faker->numberBetween(0, 1000),
            'content' => $this->faker->paragraphs(3, true),
            'comments_is_active' => $this->faker->boolean,
            'status' => $this->faker->randomElement(['published', 'draft']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
            'category_id' => $this->faker->numberBetween(1, 4),
        ];
    }
}
