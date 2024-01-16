<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($warehouses) {
            $lastWarehouses = Warehouse::orderBy('id', 'desc')->first();

            if ($lastWarehouses) {
                $lastId = substr($lastWarehouses->id_warehouses, 1);
                $newId = 'W' . str_pad((int) $lastId + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $newId = 'W0001';
            }

            $warehouses->id_warehouses = $newId;
        });
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }
}
