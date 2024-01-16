<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function goodReceipt()
    {
        return $this->belongsTo(GoodReceipt::class);
    }
    public function bin()
    {
        return $this->belongsTo(Bin::class);
    }
    public function lot()
    {
        return $this->belongsTo(Lot::class, 'lot_id');
    }
    public function part()
    {
        return $this->belongsTo(Part::class);
    }
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function salesOrderItem()
    {
        return $this->hasMany(SalesOrderItem::class);
    }
    public function inventoryMovement()
    {
        return $this->hasMany(InventoryMovement::class);
    }
    public function adjustStock()
    {
        return $this->hasMany(AdjustStock::class, 'inventory_id');
    }
    public function inventoryTransferItem()
    {
        return $this->hasMany(inventoryTransferItem::class);
    }
}
