<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Principal extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($principals) {
            $lastPrincipals = Principal::orderBy('id', 'desc')->first();

            if ($lastPrincipals) {
                $lastId = substr($lastPrincipals->id_principals, 1);
                $newId = 'P' . str_pad((int) $lastId + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $newId = 'P0001';
            }

            $principals->id_principals = $newId;
        });
    }
    public function purchaseorder()
    {
        return $this->hasMany(PurchaseOrder::class, 'principal_id');
    }
}
