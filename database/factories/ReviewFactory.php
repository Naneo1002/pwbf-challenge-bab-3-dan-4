<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Rating distribution: 40% -> 5, 30% -> 4, 20% -> 3, 10% -> 1-2
        $roll = $this->faker->numberBetween(1, 100);
        if ($roll <= 40) {
            $rating = 5;
        } elseif ($roll <= 70) {
            $rating = 4;
        } elseif ($roll <= 90) {
            $rating = 3;
        } else {
            $rating = $this->faker->numberBetween(1, 2);
        }

        // Ensure there is at least one user and one product when factories run standalone
        $userId = User::query()->inRandomOrder()->value('id') ?? User::factory()->create()->id;
        $productId = Product::query()->inRandomOrder()->value('id') ?? Product::factory()->create()->id;

        return [
            'user_id' => $userId,
            'product_id' => $productId,
            'rating' => $rating,
            'comment' => $this->faker->optional(0.85)->paragraph(),
            'created_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
        ];
    }
}
