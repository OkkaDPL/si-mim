<?php

namespace App\Models;

use App\Http\Controllers\AdjustStockController;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function employee()
    {
        return $this->hasMany(Employee::class);
    }

    public function goodReceipt()
    {
        return $this->hasMany(GoodReceipt::class);
    }

    public function inventoryTransfer()
    {
        return $this->hasMany(InventoryTransfer::class);
    }
    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }
    public function purchaseOrder()
    {
        return $this->hasMany(PurchaseOrder::class);
    }
    public function salesOrder()
    {
        return $this->hasMany(SalesOrder::class);
    }
    public function adjStock()
    {
        return $this->hasMany(AdjustStock::class);
    }
}
