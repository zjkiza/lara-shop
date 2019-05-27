<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Picture.
 *
 * @property int    $id
 * @property string $name
 * @property int    $priority
 * @property int    $product_id
 */
class Picture extends Model
{
    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
