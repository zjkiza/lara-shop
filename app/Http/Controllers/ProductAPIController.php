<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiModelNotFound;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Repository\IProduct;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductAPIController extends BaseApiController
{
    /**
     * @var IProduct
     */
    private $product;

    /**
     * ProductController constructor.
     *
     * @param IProduct $product
     */
    public function __construct(IProduct $product)
    {
        $this->product = $product;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $products = $this->product->getAllProduct($request->query->get('search'));

        if (! $products) {
            throw new ApiModelNotFound('Does not exist any data with the specified identification');
        }

        $productsCollection = new ProductCollection($products);

        return $this->createApiResponse(
            200,
            'Success find',
            true,
            $productsCollection
        );
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $product = $this->product->getProduct($id);
        } catch (ModelNotFoundException $exception) {
            throw new ApiModelNotFound('');
        }

        $productResource = new ProductResource($product);

        return $this->createApiResponse(
            200,
            'Success find',
            true,
            $productResource
        );
    }

    /**
     * @param StoreProductRequest $request
     * @return JsonResponse
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        $this->product->storeProduct($request->validated(), $request->get('details'));

        return $this->createApiResponse(201, 'Product success add');
    }

    /**
     * @param int                 $id
     * @param StoreProductRequest $request
     * @return JsonResponse
     */
    public function update(int $id, StoreProductRequest $request): JsonResponse
    {
        $this->product->updateProduct($id, $request->validated(), $request->get('details'));

        return $this->createApiResponse(200, 'Product success update');
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->product->deleteProduct($id);
        } catch (ModelNotFoundException $exception) {
            throw new ApiModelNotFound('Does not exist any data with the specified identification');
        }

        return $this->createApiResponse(204, 'Product success delete');
    }
}
