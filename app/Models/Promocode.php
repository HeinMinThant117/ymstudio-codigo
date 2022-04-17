<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    use HasFactory;


    protected $fillable = ['promo_code', 'discount', 'expired'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'promocode_user', 'promo_code', 'user_id', 'promo_code', 'id');
    }
}
