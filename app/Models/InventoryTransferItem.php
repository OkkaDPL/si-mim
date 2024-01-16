<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryTransferItem extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }
    public function inventoryTransfer()
    {
        return $this->belongsTo(inventoryTransfer::class, 'inventory_id');
    }
}
