<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Producto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           
            'nombre' => $this->faker->name,
            'cantidad' => $this->faker->numberBetween(1,999),
            'valorunitario' => $this->faker->numberBetween(1,10000),
        ];
    }
}
