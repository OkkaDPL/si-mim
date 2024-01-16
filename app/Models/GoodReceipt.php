<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodReceipt extends Model
{
    protected $guarded = ['id'];
    use HasFactory;
    protected static function boot()
    {

        parent::boot();

        static::creating(function ($idGr) {
            $lastGoodReceipt = static::orderBy('id_goodreceipt', 'desc')->first();

            if ($lastGoodReceipt) {
                $lastNumber = substr($lastGoodReceipt->id_goodreceipt, -4);
                $newNumber = str_pad(intval($lastNumber) + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '0001';
            }

            $idGr->id_goodreceipt = 'GR' . date('dmY') . $newNumber;
        });
    }

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchaseorder_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }
    public function goodReceiptItem()
    {
        return $this->hasMany(GoodReceiptItem::class, 'goodReceipt_id');
    }
}
