<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->sentence(3);
        $details = $this->faker->text();
        $number = 'product-' . date('y') . '-' . $this->faker->unique()->randomNumber(6);
        $price = $this->faker->randomFloat(2, 10, 500);
        $status = 0;
        $category = Category::inRandomOrder()->first();
        $user = User::where('role_id', 2)->inRandomOrder()->first();
        // dd($user);
        return [
            'product_name' => $name,
            'category_id' => $category->id,
            'user_id' => $user->id,
            'product_details' => $details,
            'product_number' => $number,
            'product_price' => $price,
            'product_image' => 'image.jpg',
            'product_status' => $status,
            'sell_status' => $status,
        ];
    }
}
