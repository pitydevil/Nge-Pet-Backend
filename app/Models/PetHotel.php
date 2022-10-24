<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetHotel extends Model
{
    use HasFactory;

    protected $table='pet_hotels';

    protected $primaryKey = 'pet_hotel_id';
    protected $fillable = ['pet_hotel_name', 'pet_hotel_description', 'pet_hotel_longitude','pet_hotel_latitude', 'pet_hotel_address', 'pet_hotel_kelurahan', 'pet_hotel_kecamatan', 'pet_hotel_kota', 'pet_hotel_provinsi', 'pet_hotel_pos'];
    protected $hidden = ['created_at', 'updated_at'];

    public function asuransi()
    {
        return $this->hasMany('App\Models\Asuransi');
    }

    public function cancelSOP()
    {
        return $this->hasMany('App\Models\CancelSOP');
    }

    public function fasilitas()
    {
        return $this->hasMany('App\Models\Fasilitas');
    }

    public function order()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function package()
    {
        return $this->hasMany('App\Models\Package');
    }

    public function petHotelImage()
    {
        return $this->hasMany(PetHotelImage::class, 'pet_hotel_id');
    }

    public function sopGeneral()
    {
        return $this->hasMany('App\Models\SOPGeneral');
    }

    public function supportedPet()
    {
        return $this->hasMany(SupportedPet::class, 'pet_hotel_id');
    }
}
