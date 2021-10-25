<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Str;


class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $faker = \Faker\Factory::create();
        
        return [
            
            'user_id'=>User::factory(),
            'title'=>$faker->sentence,
            'post_image'=>$faker->imageUrl('900','300'),
            'body'=>$faker->paragraph


        ];
    }
}
