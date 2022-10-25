<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SOPGeneral extends Model
{
    use HasFactory;

    protected $table='sop_generals';

    protected $primaryKey = 'sop_generals_id';
    protected $fillable = ['sop_generals_description', 'pet_hotel_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function petHotel()
    {
        return $this->belongsTo(PetHotel::class, 'pet_hotel_id');
    }
}
