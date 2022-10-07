<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $table='fasilitas';

    protected $primaryKey = 'fasilitas_id';
    protected $fillable = ['fasilitas_name', 'fasilitas_description'];
    protected $hidden = ['created_at', 'updated_at'];

    public function package() {
        return $this->belongsTo(Package::class, 'fasilitas_id', 'fasilitas_id');
    }

    public function petHotel() {
        return $this->belongsTo(PetHotel::class, 'fasilitas_id', 'fasilitas_id');
    }
}
