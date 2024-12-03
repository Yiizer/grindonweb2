<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Add reference_number to the fillable properties so it can be mass-assigned
    protected $fillable = [
        'user_id',
        'product_id',
        'name',
        'rec_address',
        'phone',
        'size',
        'logo',
        'quantity',
        'status',
        'payment_method',
        'reference_number', // Include reference_number for GCash payments
    ];

    // Relationship with the User model
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    // Relationship with the Product model
    public function product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }
}
