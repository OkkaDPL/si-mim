<?php

namespace App\Models;

use App\Models\Bin;
use App\Models\Lot;
use App\Models\Part;
use App\Models\Category;
use App\Models\Division;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function part()
{
    return $this->belongsTo(Part::class);
}

    public function category()
{
    return $this->belongsTo(Category::class);
}

    public function lot()
{
    return $this->belongsTo(Lot::class);
}

    public function division()
{
    return $this->belongsTo(Division::class);
}

public function bin()
{
    return $this->belongsTo(Bin::class);
}

}

