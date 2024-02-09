<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function locals() {
        return $this->belongsTo(Local::class)->onDelete('cascade');
    }

    public function users() {
        return $this->belongsTo(User::class)->onDelete('cascade');
    }
}
