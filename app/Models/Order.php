<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'subtotal', 'gst', 'discount', 'grand_total'];

    protected $hidden = ['created_at', 'updated_at'];

    public function classPacks()
    {
        return $this->belongsToMany(ClassPack::class, 'class_pack_order', 'order_id', 'pack_id', 'id', 'pack_id')->withPivot(['qty', 'price']);
    }
}
