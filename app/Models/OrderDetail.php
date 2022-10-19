<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table='order_details';

    protected $primaryKey = 'order_detail_id';
    protected $fillable = ['pet_name', 'pet_type', 'pet_size', 'order_detail_price', 'package_id', 'order_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function package()
    {
        return $this->belongsTo('App\Models\Package', 'package_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    public function customSOP()
    {
        return $this->hasMany('App\Models\CustomSOP');
    }

    public function monitoring()
    {
        return $this->hasMany('App\Models\Monitoring');
    }
}
