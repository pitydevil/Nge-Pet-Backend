<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $table='fasilitas';

    protected $primaryKey = 'fasilitas_id';
    protected $fillable = ['fasilitas_name', 'fasilitas_icon_url', 'fasilitas_status', 'pet_hotel_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function petHotel()
    {
        return $this->belongsTo(PetHotel::class, 'pet_hotel_id');
    }
}
