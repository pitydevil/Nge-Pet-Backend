<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportedPetType extends Model
{
    use HasFactory;
    protected $table='supported_pet_types';

    protected $primaryKey = 'supported_pet_type_id';
    protected $fillable = ['supported_pet_type_short_size', 'supported_pet_type_size', 'supported_pet_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function supportedPet()
    {
        return $this->belongsTo('App\Models\SupportedPet', 'supported_pet_id');
    }
}
