<?php

namespace Database\Factories;

use App\Models\ToDo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ToDoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ToDo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'title'=> $this->faker->word,
            'description'=> $this->faker->text,
            'due_at'=> '2021-01-08',
        ];
    }
}
