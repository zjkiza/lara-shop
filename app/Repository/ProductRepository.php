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

        if($inputSearch !== null){
            $products->where('name', 'like', '%'.$inputSearch.'%');
        }

        return $products->paginate(10);
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