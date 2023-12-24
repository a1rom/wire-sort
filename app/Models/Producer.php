<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producer extends Model
{
    use HasFactory;

    protected $table = 'producers';
    
    protected $fillable = [
        'name',
    ];

    /**
     * @return HasMany<Product>
     */
    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
    }
}
