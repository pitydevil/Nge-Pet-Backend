<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportedPet extends Model
{
    use HasFactory;

    protected $table='supported_pets';

    protected $primaryKey = 'supported_pet_id';
    protected $fillable = ['supported_pet_name', 'pet_hotel_id', 'supported_pet_type_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function petHotel()
    {
        return $this->belongsTo('App\Models\PetHotel', 'pet_hotel_id');
    }

    public function supportedPet()
    {
        return $this->belongsTo('App\Models\SupportedPetType', 'supported_pet_type_id');
    }

    public function package()
    {
        return $this->hasMany('App\Models\Package');
    }
}
