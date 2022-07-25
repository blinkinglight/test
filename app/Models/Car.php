<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    public $timestamps = false;

    protected $guarded = ['id'];

    protected $hidden = [
        'id',
        'price',
        "car_status_id",
        "car_management_id",
        "prev_car_management_id",
    ];

    public function management()
    {
        return $this->belongsTo(CarManagement::class, "car_management_id", "id");
    }

    public function prevManagement()
    {
        return $this->belongsTo(CarManagement::class, "prev_car_management_id", "id");
    }

    public function status()
    {
        return $this->belongsTo(CarStatus::class, "car_status_id", "id");
    }
}
