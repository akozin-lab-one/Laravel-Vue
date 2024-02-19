<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Owner;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        return [
            'name' =>$this->faker->name,
            'description' => $this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'price' => $faker->numerify('######'),
            'status' => $this->faker->boolean,
            // 'condition' => $this->faker->word,
            // 'type' => $this->faker->name,
            'photo' => $this->faker->url,
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'owner_id' => Owner::factory()
        ];
    }
}
