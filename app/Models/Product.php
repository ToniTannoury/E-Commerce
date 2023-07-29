<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        "customer_id",
        "title",
        "amount",
        "description"
    ];


    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function favoritedByCustomers()
    {
        return $this->belongsToMany(Customer::class, 'favorites')->withTimestamps();
    }
}