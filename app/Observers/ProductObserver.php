<?php

namespace App\Observers;

use App\Model\Product;

class ProductObserver
{
    /**
     * Handle the product "updated" event.
     *
     * @param  Product $product
     * @return void
     */
    public function updated(Product $product): void
    {
        if ((int)$product->quantity === 0 && $product->status !== 'old') {

            $product->status = 'old';
            $product->save();
        }
    }
}
