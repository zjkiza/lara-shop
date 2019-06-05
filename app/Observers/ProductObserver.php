<?php

namespace App\Observers;

use App\Model\Product;

final class ProductObserver
{
    /**
     * Handle the product "updated" event.
     *
     * @param Product $product
     */
    public function updated(Product $product): void
    {
        if ((int) $product->quantity === 0 && $product->status !== 'old') {
            $product->status = 'old';
            $product->save();
        }
    }
}
