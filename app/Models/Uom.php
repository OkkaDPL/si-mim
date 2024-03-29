<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uom extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function part()
    {
        return $this->hasMany(Part::class);
    }
}
