<?php

use App\Http\Resources\Cars2Resource;
use App\Http\Resources\CarsResource;
use App\Models\Car;
use App\Models\CarManagement;
use App\Models\CarStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get("/cars", function () {
    $filter =  request()->filter?? date("Y-m-d") ;
    $cars = Car::query()
        ->with([
            "management2" => function ($query) use ($filter) {
                return $query->where(function ($query) use ($filter) {
                    return $query
                        ->where("date_from", "<=", $filter)
                        ->where("date_to", ">=", $filter);
                })
                ->orderBy("id", "desc")
                ->limit(1);
            },
            "management2.departament",
            "management2.user",
            "management3" => function ($query) use ($filter) {
                return $query
                    ->where("date_to", "<", $filter)
                    ->orderBy("id", "asc")
                    ->limit(1);
            },
            "management3.departament",
            "management3.user",
            "carStatus" => function ($query) use ($filter) {
                return $query
                    ->with("status")
                    ->where("date_from", "<=", $filter)
                    ->where("date_to", ">=", $filter);
            },
        ])
        ->paginate(30);
    return Cars2Resource::collection($cars);
});

Route::get("/cars-raw", function () {
    $filter = request()->filter?? date("Y-m-d") ;
    $data = DB::table("cars")
        ->selectRaw("
            cars.*, (
            select statuses.name
                from car_status
                inner join statuses on statuses.id = car_status.status_id
                where car_id = cars.id and car_status.date_from <= ? and car_status.date_to >= ?
                order by car_status.id desc limit 1
            ) as status,
            ( select IFNULL(users.name, departaments.name) as name
                    from car_management
                    left join departaments on departaments.id = car_management.departament_id
                    left join users on users.id = car_management.user_id
                    where car_id = cars.id and car_management.date_from <= ? and car_management.date_to >= ?
                    order by car_management.id desc limit 1
            ) as cname,
            ( select IFNULL(users.name, departaments.name) as name
                    from car_management
                    left join departaments on departaments.id = car_management.departament_id
                    left join users on users.id = car_management.user_id
                    where car_id = cars.id and car_management.date_to < ?
                    order by car_management.id asc limit 1
            ) as pname
        ", [
            $filter, $filter, $filter, $filter, $filter
        ])

        ->orderBy("cars.id", "asc")
        ->simplePaginate(30);
    return CarsResource::collection($data);
});
