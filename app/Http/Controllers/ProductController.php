<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Repository\CategoryRepository;
use App\Repository\DetailRepository;
use App\Repository\IProduct;
use App\Repository\ManufacturerRepository;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class ProductController extends Controller
{
    /**
     * @var IProduct
     */
    private $product;

    /**
     * ProductController constructor.
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
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManufacturerRepository $manufacturerRepository
     * @param CategoryRepository $categoryRepository
     * @param DetailRepository $detailRepository
     *
     * @return \Illuminate\Http\Response
     */
    public function create(
        ManufacturerRepository $manufacturerRepository,
        CategoryRepository $categoryRepository,
        DetailRepository $detailRepository
    )
    {
        return view('product.create', [
            'manufacturers' => $manufacturerRepository->getManufacturerForForm(),
            'categories' => $categoryRepository->getCategoryForForm(),
            'details' => $detailRepository->getDetailForForm(),
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->product->storeProduct((new Product())->validateData(), $request->get('details'));

        return redirect()->route('product.index');
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
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
