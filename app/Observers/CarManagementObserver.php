<?php

namespace App\Observers;

use App\Models\Car;
use App\Models\CarManagement;

class CarManagementObserver
{
    public function creating(CarManagement $cm) {
        $car = Car::where("id", $cm->car_id)->first();

        $car->update([
            "prev_car_management_id" => $car->car_management_id
        ]);
    }

    public function created(CarManagement $cm) {
        Car::where("id", $cm->car_id)->first()->update([
            "car_management_id" => $cm->id,
        ]);
    }

    public function updated(CarManagement $cm) {
        Car::where("id", $cm->car_id)->first()->update([
            "car_status_id" => $cm->status_id,
        ]);
    }
}
