<?php
/**
 * User: zjkiza
 * Date: 4/23/19
 * Time: 10:08 AM
 */

namespace App\Repository;

use App\Model\Picture;
use App\Model\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PictureRepository implements IPicture
{
    /** @var Builder */
    private $picture;

    /**
     * ProductRepository constructor.
     */
    public function __construct()
    {
        $this->picture = (new Picture())->newQuery();
    }

    public function getAllPicture(?string $inputSearch): LengthAwarePaginator
    {
        // TODO: Implement getAllPicture() method.
    }

    public function getPictureForForm()
    {
        // TODO: Implement getPictureForForm() method.
    }

    /**
     * @param int $id
     * @return Builder|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function getPicture(int $id)
    {
        return $this->picture->findOrFail($id);
    }

    /**
     * @param int $id
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getPicturesForProduct(int $id)
    {
        return $this->picture->where('product_id', '=', $id)->get();
    }

    /**
     * @param string $pictureName
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
     * @param int $id
     * @throws \Exception
     */
    public function deletePicture(int $id): void
    {
        $picture = $this->getPicture($id);
        $picture->delete();
    }

    /**
     * @param int $id
     * @return int|mixed
     */
    private function getPriorityForPicture(int $id)
    {
        $picturesForProduct = $this->getPicturesForProduct($id);

        return $picturesForProduct->isEmpty()
            ? 1
            : $picturesForProduct->max('priority') + 1;
    }
}
