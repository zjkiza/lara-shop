<?php
/**
 * Created by PhpStorm.
 * User: kiza
 * Date: 4/21/19
 * Time: 1:44 PM
 */

namespace App\Repository;

use App\Model\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductRepository implements IProduct
{
    /** @var Builder */
    private $product;

    /**
     * ProductRepository constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getAllProduct(?string $inputSearch): LengthAwarePaginator
    {
        // TODO: Implement getAllProduct() method.
    }

    public function getProduct(int $id)
    {
        // TODO: Implement getProduct() method.
    }

    public function storeProduct(array $data): void
    {
        // TODO: Implement storeProduct() method.
    }

    public function updateProduct(array $data, int $id): void
    {
        // TODO: Implement updateProduc() method.
    }

    public function deleteProduct(int $id): void
    {
        // TODO: Implement deleteProduct() method.
    }

}