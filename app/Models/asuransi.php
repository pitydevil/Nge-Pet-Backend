<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asuransi extends Model
{
    use HasFactory;

    protected $table='asuransis';

    protected $primaryKey = 'asuransi_id';
    protected $fillable = ['asuransi_name'];
    protected $hidden = ['created_at', 'updated_at'];

    public function petHotel() {
        return $this->belongsTo(PetHotel::class, 'asuransi_id', 'asuransi_id');
    }
}       
