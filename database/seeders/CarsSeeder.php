<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarManagement;
use App\Models\CarStatus;
use App\Models\Departament;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = User::factory()
            ->count(10)
            ->for(Departament::factory()->create(), "departament")
            ->create();

        $statuses = Status::factory()->count(100)->create();

        for($i=0; $i<100; $i++) {
            Car::factory()->create(['car_status_id' => $statuses->random()->id]);
        }
        $cars = Car::all();

        for($i=0; $i<100; $i++) {
            CarStatus::factory()->create([
                'car_id' => $cars->random()->id,
                'status_id' => $statuses->random()->id,
            ]);
        }

        $departaments = Departament::all();

        for ($i=0;$i<1000;$i++) {

            $data['car_id'] = $cars->random();
            if(rand(1,2) == 2) {
                $data['user_id'] = $users->random()->id;
                $data['departament_id'] = null;
            } else {
                $data['user_id'] = null;
                $data['departament_id'] = $departaments->random()->id;
            }

            CarManagement::factory()
                ->create($data);
        }
    }
}
