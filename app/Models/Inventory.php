<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory extends Model
{
    use HasFactory;
    protected $tabel = 'inventories';
    public $guarded = ['id'];

    public function sales_detail():HasMany{
        return $this->hasMany(SalesDetail::class);
    }
    public function purchase_detail():HasMany{
        return $this->hasMany(PurchaseDetail::class);
    }
}
