<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarManagement;
use App\Models\CarStatus;
use App\Models\Departament;
use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $this->new();
    }

    public function new()
    {
        DB::statement("set global innodb_flush_log_at_trx_commit=2");
        $users = User::factory()
            ->count(100)
            ->for(Departament::factory()->create(), "departament")
            ->create();

        $statuses = Status::factory()->count(100)->create();

        $departaments = Departament::all();


        Car::factory()->count(1000)->create()->each(function ($car) use ($statuses, $users, $departaments) {
            for ($i=0;$i<100;$i+=3) {
                $data['car_id'] = $car->id;

                if (rand(1, 2) == 2) {
                    $data['user_id'] = $users->random()->id;
                    $data['departament_id'] = null;
                } else {
                    $data['user_id'] = null;
                    $data['departament_id'] = $departaments->random()->id;
                }

                    $date = Carbon::now();
                    $data["date_from"] = $date->subDays($i+3)->format("Y-m-d");
                    $date = Carbon::now();
                    $data["date_to"] = $date->subDays($i)->format("Y-m-d");

                CarStatus::factory()->count(2)->create([
                    'status_id' => $statuses->random()->id, 'car_id' => $car->id,
                    'date_from' => $data["date_from"], 'date_to' => $data["date_to"]
                ]);
                CarManagement::factory()->create($data);
            }
        });
    }
}
