<?php
/**
 * User: zjkiza
 * Date: 5/20/19
 * Time: 10:31 AM
 */

namespace App\Cache;

use Illuminate\Support\Facades\Redis;

class CacheSet
{
    protected const CACHE_TIMES_5 = 60 * 5;
    protected const CACHE_TIMES_1 = 60 * 1;

    protected function remember($key, $minutes, $callback)
    {
        if ($values = Redis::get($key)) {

            return unserialize($values);
        }

        Redis::setex($key,  $minutes , serialize($values = $callback()));

        return $values;
    }
}