<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function notifications() {
        return $this->hasMany(Notification::class)->onDelete('cascade');
    }

    public function compteurs() {
        return $this->belongsTo(Compteur::class)->onDelete('cascade');
    }
}
