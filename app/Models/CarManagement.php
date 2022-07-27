<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class CarManagement extends Model
{
    use HasFactory;

    use HasEagerLimit;

    protected $table = 'car_management';

    public $timestamps = false;

    protected $guarded = ['id'];

    protected $hidden = [
        'id', 'car_id', 'user_id', 'departament_id'
    ];

    public function departament()
    {
        return $this->belongsTo(Departament::class, "departament_id", "id");
    }

    public function car()
    {
        return $this->belongsTo(Car::class, "car_id", "id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
