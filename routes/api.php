<?php

use App\Http\Resources\CarsResource;
use App\Models\Car;
use App\Models\CarManagement;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get("/cars", function() {
    $filter =  request()->filter?? date("Y-m-d") ;
    return CarsResource::collection(
        CarManagement::with("car", "car.prevManagement", "car.prevManagement.departament", "car.prevManagement.user", "car.status.status", "user", "departament")
            ->where("date_from", "<=", $filter)
            ->where("date_to", ">=", $filter)
            ->paginate(30)
    );
});
