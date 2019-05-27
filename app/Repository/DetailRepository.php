<?php
/**
 * User: zjkiza
 * Date: 4/22/19
 * Time: 9:24 AM
 */

namespace App\Repository;

use App\Model\Detail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DetailRepository implements IDetail
{
    /** @var Builder */
    private $detail;

    /**
     * ProductRepository constructor.
     */
    public function __construct()
    {
        $this->detail = (new Detail())->newQuery();
    }

    public function getAllDetail(?string $inputSearch): LengthAwarePaginator
    {
        // TODO: Implement getAllDetail() method.
    }

    public function getDetailForForm()
    {
        return $this->detail->get();
    }

    public function getDetail(int $id)
    {
        // TODO: Implement getDetail() method.
    }

    public function storeDetail(array $data): void
    {
        // TODO: Implement storeDetail() method.
    }

    public function updateDetail(array $data, int $id): void
    {
        // TODO: Implement updateDetail() method.
    }

    public function deleteDetail(int $id): void
    {
        // TODO: Implement deleteDetail() method.
    }
}
