<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryTransfer extends Model
{
    protected $guarded = ['id'];
    use HasFactory;
    protected static function boot()
    {

        parent::boot();

        static::creating(function ($idInvenTransfer) {
            $lastInvenTransfer = static::orderBy('id_inventoryTransfer', 'desc')->first();

            if ($lastInvenTransfer) {
                $lastNumber = substr($lastInvenTransfer->id_inventoryTransfer, -4);
                $newNumber = str_pad(intval($lastNumber) + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '0001';
            }

            $idInvenTransfer->id_inventoryTransfer = date('Y') . '-' . date('dm') . $newNumber;
        });
    }
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function inventoryTransferItem()
    {
        return $this->hasMany(InventoryTransferItem::class, 'inventoryTransfer_id');
    }
    public function fromBin()
    {
        return $this->belongsTo(Bin::class, 'fromBin_id');
    }
    public function toBin()
    {
        return $this->belongsTo(Bin::class, 'toBin_id');
    }
}
