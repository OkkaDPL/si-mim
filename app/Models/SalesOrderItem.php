<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderItem extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class);
    }
    public function deliveryOrderItem()
    {
        return $this->hasMany(DeliveryOrderItem::class, 'salesOrderItem_id');
    }
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
