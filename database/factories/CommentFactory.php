<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    public function __construct()
    {
        parent::__construct();
        $this->users = User::all();
    }
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //\App\Models\Item::factory()->create(); 
        //경로 안잡힘
        return [
            'text' => $this->faker->sentence(),
            'user_id' => $this->users->random()->id,
            'image' => null
        ];
    }
}
