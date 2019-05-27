<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Repository\IPicture;
use App\Repository\IProduct;
use App\Service\FileManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    /**
     * @var IProduct
     */
    private $product;

    /**
     * @var IPicture
     */
    private $picture;

    /**
     * PictureController constructor.
     *
     * @param IProduct $product
     * @param IPicture $data
     */
    public function __construct(IProduct $product, IPicture $data)
    {
        $this->product = $product;
        $this->picture = $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(int $id)
    {
        $product = $this->product->getProduct($id);

        return view('picture.addPicture', [
            'product' => $product,
        ]);
    }

    /**
     * @param int         $id
     * @param Request     $request
     * @param FileManager $fileManager
     */
    public function dropzone(int $id, Request $request, FileManager $fileManager): void
    {
        /** @var Product $product */
        $product = $this->product->getProduct($id);
        $file = $request->file('file');
        $fileName = $fileManager->uploadFile($file);
        $this->picture->storePicture($fileName, $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param int $product_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id, int $product_id): RedirectResponse
    {
        $this->picture->deletePicture($id);

        return redirect()->route('product.show', [
            'product' => $product_id,
        ]);
    }
}
