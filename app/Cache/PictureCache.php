<?php
/**
 * Created by PhpStorm.
 * User: kiza
 * Date: 5/27/19
 * Time: 12:12 PM
 */

namespace App\Cache;

use App\Model\Product;
use App\Repository\IPicture;

class PictureCache extends CacheSet implements IPicture
{
    private const PICTURE = 'picture';

    /**
     * @var IPicture
     */
    private $picture;

    /**
     * PictureCache constructor.
     *
     * @param IPicture $picture
     */
    public function __construct(IPicture $picture)
    {
        $this->picture = $picture;
    }

    public function getPicture(int $id)
    {
        return $this->picture->getPicture($id);
    }

    public function getPicturesForProduct(int $id)
    {
        return $this->picture->getPicturesForProduct($id);
    }

    public function storePicture(string $pictureName, Product $product): void
    {
        $this->picture->storePicture($pictureName, $product);
    }

    public function deletePicture(int $id): void
    {
        $this->picture->deletePicture($id);
    }

}