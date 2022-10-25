<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetHotelImage extends Model
{
    use HasFactory;

    protected $table='pet_hotel_images';

    protected $primaryKey = 'pet_hotel_image_id';
    protected $fillable = ['pet_hotel_image_url', 'pet_hotel_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function petHotel()
    {
        return $this->belongsTo(PetHotel::class, 'pet_hotel_id');
    }
}
