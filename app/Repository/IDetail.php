<?php
/**
 * Created by PhpStorm.
 * User: kiza
 * Date: 4/22/19
 * Time: 9:20 AM
 */

namespace App\Repository;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface IDetail
{
    public function getAllDetail(?string $inputSearch): LengthAwarePaginator;
    public function getDetailForForm();
    public function getDetail(int $id);
    public function storeDetail(array $data): void;
    public function updateDetail(array $data, int $id): void;
    public function deleteDetail(int $id): void;
}