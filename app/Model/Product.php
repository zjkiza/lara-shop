<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

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
}