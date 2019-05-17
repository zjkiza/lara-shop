<?php
/**
 * Created by PhpStorm.
 * User: kiza
 * Date: 5/17/19
 * Time: 11:40 AM
 */

namespace App\Repository;

use App\Service\QueryFilter;

class ProductFilters extends QueryFilter
{
    public function status(string $status)
    {
        return $this->builder->where('status', $status);
    }
}