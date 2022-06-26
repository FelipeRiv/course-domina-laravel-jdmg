<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // ## Esto se ejecuta en los seeders o en tinker App\Models\Product::factory()->count(5)->create();
        return [
            'title'         => $this->faker->sentence(3), // maximo 3 frases
            'description'   => $this->faker->paragraph(1),// maxijmo 1 parrafo largo
            'price'         => $this->faker->randomFloat($maxDecimals = 2, $minValue = 3, $maxValue = 100),
            'stock'         => $this->faker->numberBetween(1, 10), // minimo de stock 1 a 10
            'status'        => $this->faker->randomElement(['available', 'unavailable']),
        ];
    }
}
