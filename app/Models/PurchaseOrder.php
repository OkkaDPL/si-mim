<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $guarded = ['id'];
    use HasFactory;
    protected static function boot()
    {

        parent::boot();

        static::creating(function ($idPo) {
            $lastPurchaseOrder = static::orderBy('id_purchaseorder', 'desc')->first();

            if ($lastPurchaseOrder) {
                $lastNumber = substr($lastPurchaseOrder->id_purchaseorder, -4);
                $newNumber = str_pad(intval($lastNumber) + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '0001';
            }

            $idPo->id_purchaseorder = 'PO' . date('dmY') . $newNumber;
        });
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function goodReceipt()
    {
        return $this->hasOne(GoodReceipt::class);
    }
    public function principal()
    {
        return $this->belongsTo(Principal::class);
    }
    public function purchaseOrderItem()
    {
        return $this->hasMany(PurchaseOrderItem::class, 'purchaseorder_id');
    }
}
