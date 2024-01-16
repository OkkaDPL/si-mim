<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryMovement extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
