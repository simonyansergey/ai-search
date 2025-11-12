<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'image',
        'color',
        'pattern',
        'season',
        'material',
        'size'
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2'
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: $this->image ? asset('storage' . $this->image) : asset('images/placeholder.jpg')
        );
    }
}
