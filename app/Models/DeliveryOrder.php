<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryOrder extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    protected static function boot()
    {

        parent::boot();

        static::creating(function ($model) {
            $lastDo = static::orderBy('id_deliveryOrder', 'desc')->first();

            if ($lastDo) {
                $lastNumber = intval(substr($lastDo->id_deliveryOrder, -6));
                $newNumber = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '000011';
            }

            $model->id_deliveryOrder = $newNumber;
        });
    }
    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class, 'salesOrder_id');
    }
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function bin()
    {
        return $this->belongsTo(Bin::class);
    }
    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }
    public function deliveryOrderItem()
    {
        return $this->hasMany(DeliveryOrderItem::class, 'deliveryOrder_id');
    }
}
