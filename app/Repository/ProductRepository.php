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
     */
    public function __construct()
    {
        $this->product = (new Product())->newQuery();
    }

    public function getAllProduct(?string $inputSearch): LengthAwarePaginator
    {
        $products = $this->product->with('details', 'manufacturer');

        if ($inputSearch !== null) {
            $products->where('name', 'like', '%' . $inputSearch . '%');
        }

        return $products->paginate(10);
    }

    public function getProduct(int $id)
    {
        return $this->product->with('category', 'manufacturer', 'pictures', 'details')->findOrFail($id);
    }

    /**
     * @param array $data
     * @param array|null $pivot
     */
    public function storeProduct(array $data, ?array $pivot): void
    {
        /** @var Product $saveProduct */
        $saveProduct = $this->product->create($data);

        $pivotData = $pivot ?: [];
        $saveProduct->details()->sync($pivotData);
    }

    /**
     * @param int $id
     * @param array $data
     * @param array|null $pivot
     */
    public function updateProduct(int $id, array $data, ?array $pivot): void
    {
        /** @var Product $product */
        $product = $this->getProduct($id);

        $product->update($data);

        $pivotData = $pivot ?: [];
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