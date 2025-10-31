<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id','medium','time','message'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
