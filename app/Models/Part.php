<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function uom()
    {
        return $this->belongsTo(Uom::class, 'uom_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function purchaseOrderItem()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }
    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }
    public function goodReceiptItem()
    {
        return $this->hasMany(GoodReceiptItem::class);
    }
}
