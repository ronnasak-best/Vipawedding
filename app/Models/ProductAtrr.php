<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAtrr extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $fillable=['products_id','sku','size','stock'];
}
