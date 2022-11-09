<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Monitoring;
use App\Models\OrderDetail;

class CustomSOP extends Model
{
    use HasFactory;

    protected $table='custom_sops';

    protected $primaryKey = 'custom_sop_id';
    protected $fillable = ['custom_sop_name', 'order_detail_id', 'monitoring_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class, 'order_detail_id');
    }
}
