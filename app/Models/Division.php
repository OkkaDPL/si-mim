<?php

namespace App\Models;

use App\Models\Part;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Division extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function employee()
    {
        return $this->hasMany(Employee::class);
    }

    public function category()
    {
        return $this->hasMany(Category::class, 'division_id');
    }
}
