<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;

    protected $table='monitorings';

    protected $primaryKey = 'monitoring_id';
    protected $fillable = ['monitoring_activity', 'order_detail_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class, 'order_detail_id');
    }

    public function customSOP()
    {
        return $this->hasMany(CustomSOP::class, 'monitoring_id');
    }

    public function monitoringImage()
    {
        return $this->hasMany(MonitoringImage::class, 'monitoring_id');
    }
}
