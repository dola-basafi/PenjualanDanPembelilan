<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseDetail extends Model
{
    use HasFactory;

    protected $table = 'purchase_details';
    public $guarded = ['id'];

    public function purchase():BelongsTo{
        return $this->belongsTo(Purchase::class);
    }

    public function inventory():BelongsTo{
        return $this->belongsTo(Inventory::class);
    }
}
