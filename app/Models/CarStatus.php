<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarStatus extends Model
{
    use HasFactory;

    protected $table = 'car_status';

    public $timestamps = false;

    protected $guarded = ['id'];

    protected $hidden = [
        'id', 'car_id', 'user_id', 'status_id'
    ];

    public function status()
    {
        return $this->belongsTo(Status::class, "status_id", "id");
    }
}
