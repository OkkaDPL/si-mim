<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodReceiptItem extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function goodReceipt()
    {
        return $this->belongsTo(GoodReceipt::class, 'goodReceipt_id');
    }
    public function part()
    {
        return $this->belongsTo(Part::class, 'part_id');
    }
    public function lot()
    {
        return $this->belongsTo(Lot::class, 'lot_id');
    }
}
