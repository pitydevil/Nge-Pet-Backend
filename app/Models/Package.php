<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $table='packages';

    protected $primaryKey = 'package_id';
    protected $fillable = ['package_name', 'package_price', 'pet_hotel_id', 'supported_pet_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function petHotel()
    {
        return $this->belongsTo('App\Models\PetHotel', 'pet_hotel_id');
    }

    public function supportedPet()
    {
        return $this->belongsTo('App\Models\SupportedPet', 'supported_pet_id');
    }

    public function orderDetail()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }

    public function packageDetail()
    {
        return $this->hasMany('App\Models\PackageDetail');
    }
}
