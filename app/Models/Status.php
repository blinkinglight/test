<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'statuses';

    public $timestamps = false;

    protected $hidden = ['id', 'parent_id'];

    public function status() {
        return $this->belongsTo(Status::class, "parent_id", "id");
    }
}
