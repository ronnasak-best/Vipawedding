<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false;
    //protected $casts = [ 'id' => 'string' ];
    protected $keyType = 'string';
    protected $fillable = [
        'id','user_id','billing_name','billing_address','billing_phone'
        ,'startDate','endDate','late','detail_fine','other_fine','billing_subtotal','billing_deposit','billing_refund','billing_total'
        ,'account_name','account_no','bank_name'
        ,'tracking_no_send','image_payment_return','image_return_slip','payment_slip','status'
        
    ];
  
    public function user()
      {
          return $this->belongsTo(User::class);
      }
    public function ordersproduct()
      {
          return $this->hasMany(OrdersProduct::class,'order_id','id');
      }
}