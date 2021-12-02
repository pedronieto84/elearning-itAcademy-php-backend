<?php

namespace Database\Factories;

use App\Models\Test;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Test::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'items' => $this->faker->sentence(rand(2,4)),
            'title' => $this->faker->word(),
            'subTitle' => $this->faker->word(),
            'question' => $this->faker->sentence(3),
        ];
    }
}
