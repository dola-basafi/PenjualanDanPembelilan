<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SalesDetail extends Model
{
    use HasFactory;

    protected $table = 'salesdetails';
    public $guarded = ['id'];

    public function sale():HasMany{
        return $this->hasMany(Sale::class);
    }
    public function inventory():HasMany{
        return $this->hasMany(Inventory::class);
    }
}
