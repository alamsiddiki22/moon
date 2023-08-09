<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['payment_status', 'order_status'];

    function invoice_detail(){
        return $this->hasMany(Invoice_detail::class, 'invoice_id', 'id');
    }
}
