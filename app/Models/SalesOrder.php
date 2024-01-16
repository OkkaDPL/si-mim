<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $guarded = ['id'];
    use HasFactory;
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($idSo) {
            $lastSo = static::orderBy('id_salesOrder', 'desc')->first();

            if ($lastSo) {
                $lastNumber = substr($lastSo->id_salesOrder, -6);
                $newNumber = str_pad(intval($lastNumber) + 1, 6, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '000001';
            }

            $idSo->id_salesOrder = 'SO' . $newNumber;
        });

        // static::creating(function ($model) {
        //     $lastSalesOrder = static::orderBy('id_salesOrder', 'desc')->first();

        //     if ($lastSalesOrder) {
        //         $lastNumber = intval(substr($lastSalesOrder->id_salesOrder, -6));
        //         $newNumber = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
        //     } else {
        //         $newNumber = '000001';
        //     }

        //     $model->id_salesOrder = $newNumber;
        // });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bin()
    {
        return $this->belongsTo(Bin::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function salesOrderItem()
    {
        return $this->hasMany(SalesOrderItem::class, 'salesOrder_id');
    }
    public function deliveryOrder()
    {
        return $this->hasOne(DeliveryOrder::class);
    }
}
