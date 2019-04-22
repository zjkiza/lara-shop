<?php
/**
 * Created by PhpStorm.
 * User: kiza
 * Date: 4/21/19
 * Time: 1:47 PM
 */

namespace App\Repository;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface IProduct
{
    public function getAllProduct(?string $inputSearch): LengthAwarePaginator;
    public function getProduct(int $id);
    public function storeProduct(array $data, ?array $pivot): void;
    public function updateProduct(int $id, array $data, ?array $pivot): void;
    public function deleteProduct(int $id): void;
}