<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdjustStock extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($adjStock) {
            $lastAdjStock = AdjustStock::orderBy('id', 'desc')->first();

            if ($lastAdjStock) {
                $lastId = substr($lastAdjStock->id_adjStock, 3);
                $newId = 'ADJ' . str_pad((int) $lastId + 1, 5, '0', STR_PAD_LEFT);
            } else {
                $newId = 'ADJ00001';
            }

            $adjStock->id_adjStock = $newId;
        });
    }
    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'id_inventory');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
