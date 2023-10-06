<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseDetail extends Model
{
    use HasFactory;

    protected $table = 'purchasedetails';
    public $guarded = ['id'];

    public function purchase():HasMany{
        return $this->hasMany(Purchase::class);
    }

    public function inventory():HasMany{
        return $this->hasMany(Inventory::class);
    }
}
