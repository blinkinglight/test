<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    public $timestamps = false;

    protected $guarded = ['id'];

    protected $hidden = [
        "id",
        "departament_id",
    ];

    public function departament() {
        return $this->belongsTo(Departament::class, "departament_id", "id");
    }
}
