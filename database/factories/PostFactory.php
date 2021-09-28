<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{

    protected $model = Post::class;

    public function definition()
    {
        return [
            'name' => $this->faker->text(5),
            'description' => $this->faker->text(60),
            'body' => $this->faker->text(300),
            'main_image' => uniqid().'.png',
            'published_date' => $this->faker->date('Y-m-d'),
            'is_published' => $this->faker->boolean,
        ];
    }


}
