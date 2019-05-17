<?php
/**
 * User: zjkiza
 * Date: 4/22/19
 * Time: 9:22 AM
 */

namespace App\Repository;

use App\Model\Manufacturer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ManufacturerRepository implements IManufacturer
{
    /** @var Builder */
    private $manufacturer;

    /**
     * ProductRepository constructor.
     */
    public function __construct()
    {
        $this->manufacturer = (new Manufacturer())->newQuery();
    }

    public function getAllManufacturer(?string $inputSearch): LengthAwarePaginator
    {
        // TODO: Implement getAllManufacturer() method.
    }

    public function getManufacturerForForm()
    {
        return $this->manufacturer->get();
    }

    public function getManufacturer(int $id)
    {
        // TODO: Implement getManufacturer() method.
    }

    public function storeManufacturer(array $data): void
    {
        // TODO: Implement storeManufacturer() method.
    }

    public function updateManufacturer(array $data, int $id): void
    {
        // TODO: Implement updateManufacturer() method.
    }

    public function deleteManufacturer(int $id): void
    {
        // TODO: Implement deleteManufacturer() method.
    }
}