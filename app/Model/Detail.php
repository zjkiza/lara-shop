<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Detail.
 *
 * @property int     $id
 * @property string  $name
 * @property Product $products
 */
class Detail extends Model
{
    protected $guarded = [];

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'detail_product');
    }

    /**
     * @param Product $product
     *
     * @return array
     */
    public function getCheckedIds(Product $product): array
    {
        $checkedIds = [];
        foreach ($product->details as $detail) {
            $checkedIds[] = $detail->pivot->detail_id;
        }

        return $checkedIds;
    }
}
