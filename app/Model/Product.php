<?php

namespace App\Model;

use App\Service\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Product.
 *
 * @property int    $id
 * @property string $name
 * @property string $description
 * @property int    $quantity
 * @property string $status
 * @property float  $price
 * @property int    $category_id
 * @property int    $manufacturer_id
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

    /**
     * @param QueryFilter $queryFilter
     * @return Builder
     */
    public function filter(QueryFilter $queryFilter): Builder
    {
        return $queryFilter->apply($this->joinTables($this->newQuery()));
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function joinTables(Builder $builder): Builder
    {
        return $builder
            ->join('manufacturers', 'products.manufacturer_id', '=', 'manufacturers.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'manufacturers.manufacturer_name', 'categories.category_name')
        ;
    }
}
