<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function locals() {
        return $this->hasMany(Local::class)->onDelete('cascade');
    }
}
