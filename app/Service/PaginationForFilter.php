<?php
/**
 * User: zjkiza
 * Date: 5/28/19
 * Time: 1:23 PM
 */

namespace App\Service;

/**
 * Class PaginationForFilter
 *
 * @package App\Service
 */
final class PaginationForFilter
{
    /**
     * @param array $checkInputs
     * @param array $query
     * @return array
     */
    public function addQueryToPagination(
        array $checkInputs,
        array $query = []
    ): array
    {
        foreach (array_keys(request()->query()) as $key) {
            $this->checkQueryVariable($key, $checkInputs, $query);
        }

        return $query;
    }

    /**
     * @param string $key
     * @param array  $checkInputs
     * @param array  $query
     */
    private function checkQueryVariable(
        string $key,
        array $checkInputs,
        array &$query
    ): void
    {
        if (in_array($key, $checkInputs, true)) {
            $query[$key] = request()->query()[$key];
        }
    }
}
