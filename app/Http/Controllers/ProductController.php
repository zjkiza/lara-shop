<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Model\Detail;
use App\Model\Product;
use App\Repository\CategoryRepository;
use App\Repository\DetailRepository;
use App\Repository\IProduct;
use App\Repository\ManufacturerRepository;
use App\Repository\ProductFilters;
use App\Service\PaginationForFilter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
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
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $products = $this->product->getAllProduct($request->query->get('search'));

        return view('product.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManufacturerRepository $manufacturerRepository
     * @param CategoryRepository     $categoryRepository
     * @param DetailRepository       $detailRepository
     * @param Product                $product
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(
        ManufacturerRepository $manufacturerRepository,
        CategoryRepository $categoryRepository,
        DetailRepository $detailRepository,
        Product $product
    ) {
        return view('product.create', [
            'manufacturers' => $manufacturerRepository->getManufacturerForForm(),
            'categories' => $categoryRepository->getCategoryForForm(),
            'details' => $detailRepository->getDetailForForm(),
            'statuses' => $product->getStatus(),
        ]);
    }

    /**
     * @param StoreProductRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $this->product->storeProduct($request->validated(), $request->get('details'));

        return redirect()->route('product.index')->with('success', 'Product success add');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id)
    {
        $product = $this->product->getProduct($id);

        return view('product.show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int                    $id
     * @param ManufacturerRepository $manufacturerRepository
     * @param CategoryRepository     $categoryRepository
     * @param DetailRepository       $detailRepository
     * @param Detail                 $detail
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(
        int $id,
        ManufacturerRepository $manufacturerRepository,
        CategoryRepository $categoryRepository,
        DetailRepository $detailRepository,
        Detail $detail
    ) {
        /** @var Product $product */
        $product = $this->product->getProduct($id);

        return view('product.edit', [
            'product' => $product,
            'statuses' => $product->getStatus(),
            'manufacturers' => $manufacturerRepository->getManufacturerForForm(),
            'categories' => $categoryRepository->getCategoryForForm(),
            'details' => $detailRepository->getDetailForForm(),
            'checkedIds' => $detail->getCheckedIds($product),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int                 $id
     * @param StoreProductRequest $request
     *
     * @return RedirectResponse
     */
    public function update(int $id, StoreProductRequest $request): RedirectResponse
    {
        $this->product->updateProduct($id, $request->validated(), $request->get('details'));

        return redirect()
            ->route('product.index')
            ->with('success', 'Product success updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->product->deleteProduct($id);

        return redirect()
            ->route('product.index')
            ->with('success', 'Product success deleted');
    }

    /**
     * @param ProductFilters $filters
     * @param Product        $product
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function filters(ProductFilters $filters, Product $product)
    {
        $products = $product->filter($filters)->paginate(10);

        $paginationQuery = (new PaginationForFilter())->addQueryToPagination(
            ['status', 'manufacturer', 'name', 'category']
        );

        return view('product.index', [
            'products' => $products,
            'query'=> $paginationQuery,
        ]);
    }
}
