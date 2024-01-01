<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startTime = $this->faker->dateTimeBetween('7:00', '12:00')->format('H:i');
        $endTime = $this->faker->dateTimeBetween('12:00', '16:00')->format('H:i');

        return [
            'subject_id' => $this->faker->numberBetween(101, 110),
            'hari' => $this->faker->randomElement(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']),
            'jam_mulai' => $startTime,
            'jam_selesai' => $endTime,
            'ruangan' => 'A' . $this->faker->numberBetween(1, 10),
            'kode_absensi' => 'A' . $this->faker->numberBetween(1, 10),
            'tahun_akademik' => $this->faker->randomElement(['2022/2023', '2021/2022', '2023/2024']),
            'semester' => $this->faker->randomElement(['Ganjil', 'Genap']),
            'created_by' => $this->faker->name(),
            'updated_by' => $this->faker->name(),
            'deleted_by' => $this->faker->name(),
        ];
    }
}
