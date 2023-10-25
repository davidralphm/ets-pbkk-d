<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RekamMedis>
 */
class RekamMedisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pasien_id' => rand(1, 10),
            'dokter_id' => rand(11, 20),
            'kondisi_kesehatan' => $this->faker->realText(),
            'suhu_tubuh' => $this->faker->randomFloat(1, 35, 45.5),
            'url_resep' => Str::random(10),
        ];
    }
}
