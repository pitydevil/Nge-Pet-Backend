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

    public function sopGeneral() {
        return $this->hasMany(SOPGeneral::class, 'sop_generals_id', 'sop_generals_id');
    }

    public function cancelSOP() {
        return $this->hasMany(CancelSOP::class, 'cancel_sops_id', 'cancel_sops_id');
    }

    public function asuransi() {
        return $this->hasMany(Asuransi::class, 'asuransi_id', 'asuransi_id');
    }

    public function supportedPet() {
        return $this->hasMany(SupportedPet::class, 'supported_pet_id', 'supported_pet_id');
    }

    public function fasilitas() {
        return $this->hasMany(Fasilitas::class, 'fasilitas_id', 'fasilitas_id');
    }

    public function petHotelImage() {
        return $this->hasMany(PetHotelImage::class, 'pet_hotel_image_id', 'pet_hotel_image_id');
    }
}
