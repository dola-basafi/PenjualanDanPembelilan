<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Purchase extends Model
{
    use HasFactory;
    protected $tabel = 'purchases';
    public $guarded = ['id'];

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function purchase_details():HasMany{
        return $this->hasMany(PurchaseDetail::class);
    }
}
