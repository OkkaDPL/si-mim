<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($customers) {
            $lastCustomers = Customer::orderBy('id', 'desc')->first();

            if ($lastCustomers) {
                $lastId = substr($lastCustomers->id_customers, 1);
                $newId = 'C' . str_pad((int) $lastId + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $newId = 'C0001';
            }

            $customers->id_customers = $newId;
        });
    }

    public function bin()
    {
        return $this->hasMany(Bin::class);
    }
    public function salesOrder()
    {
        return $this->hasMany(SalesOrder::class);
    }
}
