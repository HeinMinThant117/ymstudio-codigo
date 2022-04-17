<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassPack extends Model
{
    use HasFactory;

    protected $fillable = ['pack_id'];
    
    protected $hidden = ['created_at', 'updated_at'];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'class_pack_order', 'pack_id', 'order_id', 'pack_id', 'id')->withPivot(['qty', 'price']);
    }
}
