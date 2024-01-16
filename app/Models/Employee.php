<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($employee) {
            $lastEmployee = Employee::orderBy('id', 'desc')->first();

            if ($lastEmployee) {
                $lastNip = $lastEmployee->nip;
                $newNip = str_pad((int) $lastNip + 1, 5, '0', STR_PAD_LEFT);
            } else {
                $newNip = '00001';
            }

            $employee->nip = $newNip;
        });
    }

    // public function getEmployee($userLogin)
    // {
    //     $getEmployee = Employee::with('departement')->where('id', '=', $userLogin)->get();
    //     foreach ($getEmployee as $i) {
    //         $getDepartement = $i->departement->nama;
    //     }
    //     return $getDepartement;
    // }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function salesOrder()
    {
        return $this->hasMany(SalesOrder::class);
    }
}
