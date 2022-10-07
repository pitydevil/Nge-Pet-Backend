<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomSOP extends Model
{
    use HasFactory;
    protected $table='custom_sops';

    protected $primaryKey = 'custom_sop_id';
    protected $fillable = ['custom_sop_name'];
    protected $hidden = ['created_at', 'updated_at'];

    public function orderDetail() {
        return $this->belongsTo(OrderDetail::class, 'custom_sop_id', 'custom_sop_id');
    }
}
