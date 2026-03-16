<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = ['name', 'address', 'phone', 'email', 'unit_price', 'unit', 'total_price', 'invoice_number'];
}
