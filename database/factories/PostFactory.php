<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // los factories usan la libreria Faker
            'titulo' => $this->faker->sentence(5), // crear un enunciado
            'descripcion' => $this->faker->sentence(20),
            'imagen' => $this->faker->uuid().'.jpg', // que las imagenes tengan el formato requerido
            'user_id' => $this->faker->randomElement([7, 2, 8, 5]),
        ];
    }
}
