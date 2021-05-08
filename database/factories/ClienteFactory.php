<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->numberBetween(1,99999),
            'nombre' => $this->faker->name,
            'apellido' => $this->faker->lastname,
            'tipodocumento' => $this->faker->randomLetter,
            'ciudad' => $this->faker->streetAddress,
            'latitud' => $this->faker->latitude($min = -90, $max = 90) ,  
            'longitud' => $this->faker->longitude($min = -180, $max = 180),  
        ];
    }
}
