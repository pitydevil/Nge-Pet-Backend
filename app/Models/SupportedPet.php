<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportedPet extends Model
{
    use HasFactory;

    protected $table='supported_pets';

    protected $primaryKey = 'supported_pet_id';
    protected $fillable = ['supported_pet_name', 'pet_hotel_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function petHotel()
    {
        return $this->belongsTo(PetHotel::class, 'pet_hotel_id');
    }

    public function supportedPetType()
    {
        return $this->hasMany(supportedPetType::class, 'supported_pet_id');
    }

    public function package()
    {
        return $this->hasMany(Package::class, 'suppoted_pet_id');
    }
}
