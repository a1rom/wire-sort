<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'producer_id',
        'name',
        'price',
        'stock',
    ];

    /**
     * @return BelongsTo<Producer, Product>
     */
    public function producer() : BelongsTo
    {
        return $this->belongsTo(Producer::class);
    }
}
