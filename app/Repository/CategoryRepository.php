<?php
/**
 * User: zjkiza
 * Date: 4/22/19
 * Time: 9:23 AM
 */

namespace App\Repository;

use App\Model\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryRepository implements ICategory
{
    /** @var Builder */
    private $category;

    /**
     * ProductRepository constructor.
     */
    public function __construct()
    {
        $this->category = (new Category())->newQuery();
    }

    public function getAllCategory(?string $inputSearch): LengthAwarePaginator
    {
        // TODO: Implement getAllCategory() method.
    }

    public function getCategoryForForm()
    {
        return $this->category->get();
    }

    public function getCategory(int $id)
    {
        // TODO: Implement getCategory() method.
    }

    public function storeCategory(array $data): void
    {
        // TODO: Implement storeCategory() method.
    }

    public function updateCategory(array $data, int $id): void
    {
        // TODO: Implement updateCategory() method.
    }

    public function deleteCategory(int $id): void
    {
        // TODO: Implement deleteCategory() method.
    }

}
