<?php
/**
 * User: zjkiza
 * Date: 5/20/19
 * Time: 10:31 AM.
 */

namespace App\Cache;

use Illuminate\Support\Facades\Redis;

class CacheSet
{
    protected const CACHE_TIME_PAGE = 60 * 1;
    protected const CACHE_TIME_ELEMENT = 60 * 1;

    /**
     * @param string $name
     * @param int    $id
     *
     * @return string
     */
    protected function getKey(string $name, int $id): string
    {
        return sprintf('%s.%s', $name, $id);
    }

    /**
     * @param string $name
     * @param int    $page
     * @param string $inputSearch
     *
     * @return string
     */
    protected function getKeyForPage(string $name, int $page, string $inputSearch): string
    {
        return sprintf('%s.%s.%s', $name, $page, $inputSearch);
    }

    /**
     * @param $key
     * @param $minutes
     * @param $callback
     *
     * @return mixed
     */
    protected function remember(string $key, int $minutes, callable $callback)
    {
        $values = Redis::get($key);

        if ($values) {
            return unserialize($values);
        }

        Redis::setex($key, $minutes, serialize($values = $callback()));

        return $values;
    }

    /**
     * @param string $keyName
     * @param string $keysName
     * @param string $idName
     * @param int    $idValue
     */
    protected function deleteFromCache(string $keyName, string $keysName, string $idName, int $idValue): void
    {
        Redis::del(
            $this->getKey($keyName, $idValue)
        );

        $this->deletePageForDeletedElement($keysName, $idName, $idValue);
    }

    /**
     * @param string $keysName
     * @param string $idName
     * @param $idValue
     */
    private function deletePageForDeletedElement(string $keysName, string $idName, int $idValue): void
    {
        $allKeys = Redis::keys(sprintf('%s.*', $keysName));
        $prefix = config('database.redis.options.prefix');
        $keys = str_replace($prefix, '', $allKeys);

        foreach ($keys as $key) {
            if (unserialize(Redis::get($key))->firstWhere($idName, $idValue)) {
                Redis::del($key);

                return;
            }
        }
    }
}
