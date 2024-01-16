<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bin extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($bins) {
            $lastBins = Bin::orderBy('id', 'desc')->first();

            if ($lastBins) {
                $lastId = substr($lastBins->id_bins, 1);
                $newId = 'B' . str_pad((int) $lastId + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $newId = 'B0001';
            }

            $bins->id_bins = $newId;
        });
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'bin_id');
    }
    public function inventoryTransfer()
    {
        return $this->hasMany(InventoryTransfer::class, 'fromBin_id');
    }
    public function salesOrder()
    {
        return $this->hasMany(SalesOrder::class);
    }
}
