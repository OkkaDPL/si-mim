<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function deliveryOrderItem()
    {
        return $this->belongsTo(DeliveryOrderItem::class, 'deliveryOrderItem_id');
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
