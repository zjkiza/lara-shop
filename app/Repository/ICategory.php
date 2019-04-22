<?php
/**
 * Created by PhpStorm.
 * User: kiza
 * Date: 4/22/19
 * Time: 9:18 AM
 */

namespace App\Repository;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ICategory
{
    public function getAllCategory(?string $inputSearch): LengthAwarePaginator;
    public function getCategoryForForm();
    public function getCategory(int $id);
    public function storeCategory(array $data): void;
    public function updateCategory(array $data, int $id): void;
    public function deleteCategory(int $id): void;
}