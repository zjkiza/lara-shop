<?php
/**
 * User: zjkiza
 * Date: 4/21/19
 * Time: 1:44 PM.
 */

namespace App\Repository;

use App\Model\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class ProductRepository implements IProduct
{
    /** @var Builder */
    private $product;

    /**
     * ProductRepository constructor.
     */
    public function __construct()
    {
        $this->product = (new Product())->newQuery();
    }

    /**
     * @param string|null $inputSearch
     * @return LengthAwarePaginator
     */
    public function getAllProduct(?string $inputSearch): LengthAwarePaginator
    {
        $products = $this->product;

        if ($inputSearch !== null) {
            $products->where('name', 'like', '%'.$inputSearch.'%');
        }

        $products = (new Product())
            ->joinTables($products)
            ->with('details', 'pictures');

        return $products->paginate();
    }

    /**
     * @param int $id
     * @return Builder|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function getProduct(int $id)
    {
        return $this
            ->product
            ->with('category', 'manufacturer', 'pictures', 'details')
            ->findOrFail($id);
    }

    /**
     * @param array      $data
     * @param array|null $pivot
     */
    public function storeProduct(array $data, ?array $pivot): void
    {
        /** @var Product $saveProduct */
        $saveProduct = $this->product->create($data);

        $pivotData = $pivot ?? [];
        $saveProduct->details()->sync($pivotData);
    }

    /**
     * @param int        $id
     * @param array      $data
     * @param array|null $pivot
     */
    public function updateProduct(int $id, array $data, ?array $pivot): void
    {
        /** @var Product $product */
        $product = $this->getProduct($id);

        $product->update($data);

        $pivotData = $pivot ?? [];
        $product->details()->sync($pivotData);
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function deleteProduct(int $id): void
    {
        $product = $this->getProduct($id);
        $product->delete();
    }
}
