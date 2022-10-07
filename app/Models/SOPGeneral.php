<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SOPGeneral extends Model
{
    use HasFactory;

    protected $table='sop_generals';
    
    protected $primaryKey = 'sop_generals_id';
    protected $fillable = ['sop_generals_description', 'sop_generals_asuransi'];
    protected $hidden = ['created_at', 'updated_at'];

    public function petHotel()
    {
        return $this->belongsTo(SOPGeneral::class, 'sop_generals_id', 'sop_generals_id');
    }
}
