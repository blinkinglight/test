<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class Car extends Model
{
    use HasFactory;

    use HasEagerLimit;

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

    public function getCurrentNameAttribute($value)
    {
        if(!$this->management2->isEmpty()) {
            return $this->management2->get(0)?->departament?->name ?? $this->management2->get(0)?->user?->name;
        }
        return null;
    }

    public function getPrevNameAttribute($value)
    {
        if(!$this->management3->isEmpty()) {
            return $this->management3->get(0)?->departament?->name ?? $this->management3->get(0)?->user?->name;
        }
        return null;
    }

    public function management2()
    {
        return $this->hasMany(CarManagement::class, "car_id", "id");
    }

    public function management3()
    {
        return $this->hasMany(CarManagement::class, "car_id", "id");
    }

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

    public function carStatus() {
        return $this->hasMany(CarStatus::class, "car_id", "id")->orderBy("id", "desc");
    }
}
