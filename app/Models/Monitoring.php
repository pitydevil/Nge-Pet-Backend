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
        return $this->belongsTo('App\Models\OrderDetail', 'order_detail_id');
    }

    public function customSOP()
    {
        return $this->hasMany('App\Models\CustomSOP');
    }

    public function monitoringImage()
    {
        return $this->hasMany('App\Models\MonitoringImage');
    }
}
