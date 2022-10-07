<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetHotel extends Model
{
    use HasFactory;

    protected $table='pet_hotels';

    protected $primaryKey = 'pet_hotel_id';
    protected $fillable = ['pet_hotel_name', 'pet_hotel_longitude','pet_hotel_latitude', 'pet_hotel_location', 'pet_hotel_description','sop_generals_id', 'asuransi_id', 'package_id', 'cancel_sops_id', 'fasilitas_id', 'supported_pet_id', 'pet_hotel_image_id'];
    protected $hidden = ['sop_generals_id', 'asuransi_id', 'package_id', 'cancel_sops_id', 'fasilitas_id', 'supported_pet_id', 'pet_hotel_image_id', 'created_at', 'updated_at'];
}
