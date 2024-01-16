<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    protected static function boot()
    {

        parent::boot();

        static::creating(function ($createIdInv) {
            $lastIdInv = static::orderBy('id_invoice', 'desc')->first();

            if ($lastIdInv) {
                $lastNumber = intval(substr($lastIdInv->id_invoice, -6));
                $newNumber = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '000001';
            }

            $createIdInv->id_invoice = $newNumber;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function deliveryOrder()
    {
        return $this->belongsTo(DeliveryOrder::class, 'deliveryOrder_id');
    }
    public function invoiceItem()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
