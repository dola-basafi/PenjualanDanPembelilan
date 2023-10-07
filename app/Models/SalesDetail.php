<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalesDetail extends Model
{
    use HasFactory;

    protected $table = 'sales_details';
    public $guarded = ['id'];

    public function sale():BelongsTo{
        return $this->belongsTo(Sale::class);
    }
    public function inventory():BelongsTo{
        return $this->belongsTo(Inventory::class);
    }
}
