<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;
use App\Models\PetHotel;
class Order extends Model
{
    use HasFactory;

    protected $table='orders';

    protected $primaryKey = 'order_id';
    protected $fillable = ['order_code', 'order_date_checkin','order_date_checkout', 'order_total_price', 'order_status','user_id', 'pet_hotel_id'];
    //protected $hidden = ['created_at', 'updated_at'];

    public function pethotel() {
        return $this->hasMany(PetHotel::class, 'pet_hotel_id', 'pet_hotel_id');
    }

    public function orderDetail() {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }
}
