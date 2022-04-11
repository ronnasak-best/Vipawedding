<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersProduct extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $fillable = ['order_id','product_id','size','quantity','fine_detail'];


    public function product()
    {
        return $this->belongsTo(Products::class,'product_id','id');
    }
}