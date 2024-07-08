<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class EventFactory extends Factory
{
    public function definition()
    {
        // Verifica se o diretório existe, caso contrário, cria o diretório
        $directory = 'storage/app/public/events';
        Storage::disk('public')->makeDirectory('events');

        return [
            'image' => $this->faker->image($directory, 640, 480, null, false),
            'event_date' => $this->faker->dateTimeBetween('+1 days', '+1 month')->format('Y-m-d H:i:s'),
            'name' => $this->faker->sentence(),
            'responsible' => $this->faker->name(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'address' => $this->faker->address(),
            'number' => $this->faker->buildingNumber(),
            'complement' => $this->faker->secondaryAddress(),
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}
