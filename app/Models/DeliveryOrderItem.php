<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryOrderItem extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function salesOrderItem()
    {
        return $this->belongsTo(SalesOrderItem::class, 'salesOrderItem_id');
    }
}
