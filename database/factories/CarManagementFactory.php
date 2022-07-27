<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarManagement>
 */
class CarManagementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $date = Carbon::now();
        return [
            "date_from" => $date->subDays(rand(1,10))->format("Y-m-d"),
            "date_to" => $date->addDays(rand(1,10))->format("Y-m-d"),
        ];
    }
}
