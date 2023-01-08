<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;


class PostFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => rand(1,10),
            'title' => fake()->sentence(3),
            'post_image' => fake()->imageUrl(900,300),
            'body' => fake()->paragraph(25),
        ];
    }
}
