<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $fillable = [
        'account_no','account_name','bank_name','bank_location','logo','status'
    ];

}
