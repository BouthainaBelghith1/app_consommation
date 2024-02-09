<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function regions() {
        return $this->hasMany(Region::class)->onDelete('cascade');
    }

    public function categories() {
        return $this->belongsTo(Categorie::class)->onDelete('cascade');
    }

    public function compteurs() {
        return $this->hasMany(Compteur::class)->onDelete('cascade');
    }
}
