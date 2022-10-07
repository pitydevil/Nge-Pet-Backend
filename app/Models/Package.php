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
}
