<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';
    public $guarded = ['id'];

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function sales_details():HasMany{
        return $this->hasMany(SalesDetail::class);
    }

}
