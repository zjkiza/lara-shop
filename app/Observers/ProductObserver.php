<?php

namespace App\Observers;

use App\Model\Product;

class ProductObserver
{
    /**
     * Handle the product "updated" event.
     *
     * @param Product $product
     */
    public function updated(Product $product): void
    {
        if (0 === (int) $product->quantity && 'old' !== $product->status) {
            $product->status = 'old';
            $product->save();
        }
    }
}
