<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compteur extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function factures() {
        return $this->hasMany(Facture::class)->onDelete('cascade');
    }

    public function locals() {
        return $this->belongsTo(Local::class)->onDelete('cascade');
    }
}
