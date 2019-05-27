<?php
/**
 * User: zjkiza
 * Date: 4/22/19
 * Time: 9:16 AM.
 */

namespace App\Repository;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface IManufacturer
{
    public function getAllManufacturer(?string $inputSearch): LengthAwarePaginator;

    public function getManufacturerForForm();

    public function getManufacturer(int $id);

    public function storeManufacturer(array $data): void;

    public function updateManufacturer(array $data, int $id): void;

    public function deleteManufacturer(int $id): void;
}
