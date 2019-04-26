<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Product
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $quantity
 * @property string $status
 * @property double $price
 * @property int $category_id
 * @property int $manufacturer_id
 *
 * @package App\Model
 */
class Product extends Model
{
    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * @return BelongsTo
     */
    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id');
    }

    /**
     * @return HasMany
     */
    public function pictures(): HasMany
    {
        return $this->hasMany(Picture::class);
    }

    /**
     * @return BelongsToMany
     */
    public function details(): BelongsToMany
    {
        return $this->belongsToMany(Detail::class, 'detail_product');
    }

    /**
     * @return array
     */
    public function getStatus(): array
    {
        return [
            'new',
            'sale',
            'old',
        ];
    }
}