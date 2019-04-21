<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Detail
 *
 * @property int $id
 * @property string $name
 *
 * @package App\Model
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
}
