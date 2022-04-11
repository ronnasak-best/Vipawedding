<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $primaryKey='id';
    protected $fillable=['users_id','name','surname','address','province','district'
    ,'sub_district','pincode','default_address','mobile','txtBank','account_name','account_no'];

}
