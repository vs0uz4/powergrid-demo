<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->randomNumber(9, true),
            'status' => $this->faker->numberBetween(0, 1),
            'enabled' => $this->faker->boolean(),
            'name' => $this->faker->jobTitle(),
            'description' =>$this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'enabled_at'=> now(),
            'publication_at' => now(),
        ];
    }
}
