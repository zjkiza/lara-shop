<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Picture
 *
 * @property int $id
 * @property string $name
 * @property int $priority
 * @property int $product_id
 *
 * @package App
 */
class Picture extends Model
{
    protected $guarded = [];
}
