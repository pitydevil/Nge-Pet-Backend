<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $table='packages';

    protected $primaryKey = 'package_id';
    protected $fillable = ['fasilitas_id', 'supported_pet_id', 'package_price'];
    protected $hidden = ['fasilitas_id', 'supported_pet_id', 'created_at', 'updated_at'];

    public function fasilitas() {
        return $this->hasMany(Fasilitas::class, 'fasilitas_id', 'fasilitas_id');
    }

    public function supportedPet() {
        return $this->hasMany(SupportedPet::class, 'supported_pet_id', 'supported_pet_id');
    }
}
