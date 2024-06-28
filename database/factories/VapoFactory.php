<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VapoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "marca" => $this -> faker -> word(),
            "modelo" => $this -> faker -> word(),
            "color" => $this -> faker -> word(),
            "potencia_maxima" => $this -> faker -> numberBetween(1,100),
            "cantidad_de_pilas" => $this -> faker -> numberBetween(1,100),
            "capacidad" => $this -> faker -> numberBetween(1,100),
            
        ];
    }
}
