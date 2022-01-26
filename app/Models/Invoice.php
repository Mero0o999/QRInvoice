<?php
// 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_date', 'customer','customer_phone', 'disscount','totalWithVAT', 'total'
    ];

    public function cust()
    {
        return $this->belongsTo('App\Models\Customer');
    }
}
