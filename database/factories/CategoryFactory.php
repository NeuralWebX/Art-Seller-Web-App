<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_name' => $this->faker->words(2, true),
            'category_details' => $this->faker->text(),
            'category_number' => 'cat-' . date('y') . '-' . $this->faker->unique()->randomNumber(6),
            'category_image' => 'image.jpg',
            'category_status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
