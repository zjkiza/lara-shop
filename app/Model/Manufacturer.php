<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Manufacturer
 *
 * @property int $id
 * @property string $name
 *
 * @package App
 */
class Manufacturer extends Model
{
    protected $guarded = [];

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
