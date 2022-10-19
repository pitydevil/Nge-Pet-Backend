<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportedPetType extends Model
{
    use HasFactory;
    protected $table='supported_pet_types';

    protected $primaryKey = 'supported_pet_type_id';
    protected $fillable = ['ssupported_pet_type_name'];
    protected $hidden = ['created_at', 'updated_at'];

    public function supportedPet()
    {
        return $this->hasMany('App\Models\SupportedPet');
    }
}
