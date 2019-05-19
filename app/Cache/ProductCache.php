<?php
/**
 * User: zjkiza
 * Date: 5/19/19
 * Time: 6:18 PM
 */

namespace App\Cache;

use App\Repository\IProduct;
use App\Repository\ProductRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductCache implements IProduct
{
    /** @var ProductRepository */
    private $product;

    /**
     * ProductCache constructor.
     * @param IProduct $product
     */
    public function __construct(IProduct $product)
    {
        $this->product = $product;
    }

    /**
     * @param null|string $inputSearch
     * @return LengthAwarePaginator
     */
    public function getAllProduct(?string $inputSearch): LengthAwarePaginator
    {
        $page = request()->input('page') ?? 'zero';
        $inputSearch = $inputSearch ?? '';

        return \Cache::remember("product1.all.{$page}.{$inputSearch}", 60*60, function () use ($inputSearch) {

            return $this->product->getAllProduct($inputSearch);
        });
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getProduct(int $id)
    {
        return \Cache::remember("product.{$id}", 60*60, function () use ($id) {

            return $this->product->getProduct($id);
        });
    }

    /**
     * @param array $data
     * @param array|null $pivot
     */
    public function storeProduct(array $data, ?array $pivot): void
    {
        $this->product->storeProduct($data, $pivot);
    }

    /**
     * @param int $id
     * @param array $data
     * @param array|null $pivot
     */
    public function updateProduct(int $id, array $data, ?array $pivot): void
    {
        $this->product->updateProduct($id, $data, $pivot);
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function deleteProduct(int $id): void
    {
        $this->product->deleteProduct($id);
    }
}