<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $table='owners';

    protected $primaryKey = 'owner_id';
    protected $fillable = ['username', 'email', 'password'];
    protected $hidden = ['created_at', 'updated_at'];

    public function petHotel()
    {
        return $this->hasOne(PetHotel::class, 'owner_id');
    }
}
