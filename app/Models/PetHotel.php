<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetHotel extends Model
{
    use HasFactory;

    protected $table='pet_hotels';

    protected $primaryKey = 'pet_hotel_id';
    protected $fillable = ['pet_hotel_name', 'pet_hotel_description', 'pet_hotel_longitude','pet_hotel_latitude', 'pet_hotel_address', 'pet_hotel_kelurahan', 'pet_hotel_kecamatan', 'pet_hotel_kota', 'pet_hotel_provinsi', 'pet_hotel_pos', 'owner_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function asuransi()
    {
        return $this->hasMany(Asuransi::class, 'pet_hotel_id');
    }

    public function cancelSOP()
    {
        return $this->hasMany(CancelSOP::class, 'pet_hotel_id');
    }

    public function fasilitas()
    {
        return $this->hasMany(Fasilitas::class, 'pet_hotel_id');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'pet_hotel_id');
    }

    public function package()
    {
        return $this->hasMany(Package::class, 'pet_hotel_id');
    }

    public function petHotelImage()
    {
        return $this->hasMany(PetHotelImage::class, 'pet_hotel_id');
    }

    public function sopGeneral()
    {
        return $this->hasMany(SOPGeneral::class, 'pet_hotel_id');
    }

    public function supportedPet()
    {
        return $this->hasMany(SupportedPet::class, 'pet_hotel_id');
    }

    public function owner()
    {
        return $this->hasOne(Owner::class, 'owner_id');
    }
}
