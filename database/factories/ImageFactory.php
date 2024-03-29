<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     * By default its gonna be products and after that we are gonna create a different state for users
     *
     * @return array
     */
    public function definition()
    {
        // ! fixed with .jpg -> . missing
        $fileName = $this->faker->numberBetween(1, 10) . '.jpg';

        return [
            'path' => "img/products/{$fileName}",
        ];

    }

    /**
     * Define a state to create a different path depending on the 
     */
    public function user(){
            // ! fixed with .jpg -> . missing
        $fileName = $this->faker->numberBetween(1, 5) . '.jpg';

        return $this->state([
            'path' => "img/users/{$fileName}",
        ]);
    }

}
