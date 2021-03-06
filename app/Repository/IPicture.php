<?php
/**
 * User: zjkiza
 * Date: 4/23/19
 * Time: 10:03 AM.
 */

namespace App\Repository;

use App\Model\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface IPicture
{
    public function getPicture(int $id);

    public function getPicturesForProduct(int $id);

    public function storePicture(string $pictureName, Product $product): void;

    public function deletePicture(int $id): void;
}
