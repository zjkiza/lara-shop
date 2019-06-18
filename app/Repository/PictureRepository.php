<?php
/**
 * User: zjkiza
 * Date: 4/23/19
 * Time: 10:08 AM.
 */

namespace App\Repository;

use App\Model\Product;
use Illuminate\Database\Eloquent\Builder;

class PictureRepository implements IPicture
{
    /** @var Builder */
    private $builder;

    /**
     * ProductRepository constructor.
     * @param Builder $builder
     */
    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param  int $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static|static[]
     */
    public function getPicture(int $id)
    {
        return $this->builder->findOrFail($id);
    }

    /**
     * @param  int $id
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getPicturesForProduct(int $id)
    {
        return $this->builder->where('product_id', '=', $id)->get();
    }

    /**
     * @param string  $pictureName
     * @param Product $product
     */
    public function storePicture(string $pictureName, Product $product): void
    {
        $product->pictures()->create([
            'name' => $pictureName,
            'priority' => $this->getPriorityForPicture($product->id),
        ]);
    }

    /**
     * @param  int $id
     * @throws \Exception
     */
    public function deletePicture(int $id): void
    {
        $picture = $this->getPicture($id);
        $picture->delete();
    }

    /**
     * @param  int $id
     * @return int
     */
    private function getPriorityForPicture(int $id): int
    {
        $picturesForProduct = $this->getPicturesForProduct($id);

        return $picturesForProduct->isEmpty()
            ? 1
            : $picturesForProduct->max('priority') + 1;
    }
}
