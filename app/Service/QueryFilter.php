<?php
/**
 * User: zjkiza
 * Date: 5/17/19
 * Time: 11:37 AM.
 */

namespace App\Service;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    protected const ORDER_BY = ['asc', 'desc'];
    protected const DEFAULT_ORDER_BY = 'asc';

    /** @var Request $request */
    protected $request;

    /** @var Builder $builder */
    protected $builder;

    /**
     * QueryFilter constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return $this->request->all();
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            if (method_exists($this, $name)) {
                call_user_func_array([$this, $name], array_filter([$value]));
            }
        }

        return $this->builder;
    }

    /**
     * @param string $order
     * @return string
     */
    protected function validOrderBy(string $order): string
    {
        return in_array($order, self::ORDER_BY, true)
            ? $order
            : self::DEFAULT_ORDER_BY;
    }
}
