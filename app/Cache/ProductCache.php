<?php
/**
 * User: zjkiza
 * Date: 5/19/19
 * Time: 6:18 PM.
 */

namespace App\Cache;

use App\Repository\IProduct;
use App\Repository\ProductRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductCache extends CacheSet implements IProduct
{
    private const PRODUCT = 'product';
    private const PRODUCTS = 'products.all';

    /** @var ProductRepository */
    private $product;

    /**
     * ProductCache constructor.
     *
     * @param IProduct $product
     */
    public function __construct(IProduct $product)
    {
        $this->product = $product;
    }

    /**
     * @param string|null $inputSearch
     *
     * @return LengthAwarePaginator
     */
    public function getAllProduct(?string $inputSearch): LengthAwarePaginator
    {
        $page = request()->input('page') ?? '0';
        $inputSearch = $inputSearch ?? '';

        return $this->remember(
            $this->getKeyForPage(self::PRODUCTS, $page, $inputSearch),
            $this::CACHE_TIME_PAGE,
            function () use ($inputSearch) {
                return $this->product->getAllProduct($inputSearch);
            });
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function getProduct(int $id)
    {
        return $this->remember(
            $this->getKey(self::PRODUCT, $id),
            $this::CACHE_TIME_ELEMENT,
            function () use ($id) {
                return $this->product->getProduct($id);
            });
    }

    /**
     * @param array      $data
     * @param array|null $pivot
     */
    public function storeProduct(array $data, ?array $pivot): void
    {
        $this->product->storeProduct($data, $pivot);
    }

    /**
     * @param int        $id
     * @param array      $data
     * @param array|null $pivot
     */
    public function updateProduct(int $id, array $data, ?array $pivot): void
    {
        $this->product->updateProduct($id, $data, $pivot);
        $this->deleteFromCache(self::PRODUCT, self::PRODUCTS, 'id', $id);
    }

    /**
     * @param int $id
     *
     * @throws \Exception
     */
    public function deleteProduct(int $id): void
    {
        $this->product->deleteProduct($id);
        $this->deleteFromCache(self::PRODUCT, self::PRODUCTS, 'id', $id);
    }
}
