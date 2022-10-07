<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table='orders';

    protected $primaryKey = 'order_id';
    protected $fillable = ['order_name', 'order_status','order_date_checkin', 'order_date_checkout', 'user_id','pet_hotel_id'];
    protected $hidden = ['order_date_checkin', 'order_date_checkout','user_id', 'pet_hotel_id', 'created_at', 'updated_at'];

    public function orderDetail() {
        return $this->hasMany(OrderDetail::class, 'order_detail_id', 'order_detail_id');
    }
}
