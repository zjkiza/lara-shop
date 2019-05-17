<?php
/**
 * User: zjkiza
 * Date: 5/17/19
 * Time: 11:40 AM
 */

namespace App\Repository;

use App\Service\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ProductFilters
 * @package App\Repository
 */
class ProductFilters extends QueryFilter
{
    /**
     * @param string $status
     * @return Builder
     */
    public function status(string $status): Builder
    {
        return $this->builder->where('status', $status);
    }

    /**
     * @param string $order
     * @return Builder
     */
    public function manufacturer(string $order = 'asc'): Builder
    {
        return $this->builder->orderBy('manufacturer_name', $order);
    }
}