<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportedPet extends Model
{
    use HasFactory;

    protected $table='supported_pets';

    protected $primaryKey = 'supported_pet_id';
    protected $fillable = ['supported_pet_name', 'supported_pet_type_id'];
    protected $hidden = ['supported_pet_type_id', 'created_at', 'updated_at'];


    public function supportedPetType() {
        return $this->hasMany(SupportedPetType::class, 'supported_pet_type_id', 'supported_pet_type_id');
    }
}
