<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Donasi;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donasi>
 */
class DonasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Donasi::class;
    public function definition(): array
    {
        $statusOptions = ['menunggu konfirmasi', 'dikonfirmasi', 'batal'];
        $metodePembayaranOptions = ['Transfer Bank', 'Gopay', 'OVO', 'Dana', 'Kartu Kredit'];
        return [
            //
            'nama_donatur' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'nominal' => $this->faker->numberBetween(10000, 5000000),
            'metode_pembayaran' => $this->faker->randomElement($metodePembayaranOptions),
            'tanggal_donasi' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'status' => $this->faker->randomElement($statusOptions),
            'created_at' => now(),
            'updated_at' => now(),

        ];
    }
}
