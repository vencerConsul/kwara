<?php

namespace App\Http\Traits;

use App\Product;

trait ProductTrait
{
    public function getProducts()
    {
        $products = Product::all();

        if ($products->count() > 0) {
            foreach ($products as $prod) {


                $image = explode('|', $prod->product_image);

                echo '<div class="col-lg-2 col-sm-4 col-6 section__three__col">
                    <a href="product/' . $prod->id . '">
                        <div class="card mb-2">
                            <img class="card-img-top" src="' . asset("/storage/images/products/$image[0]") . '" />
                            <div class="card-body">
                                <p class="card-title p-name">' . $prod->product_name . '</p>
                                <p class="card-text">&#8369; ' . number_format($prod->product_price) . '</p>
                            </div>
                        </div>
                    </a>
                </div>';
            }
        } else {
            echo '<div class="section__three__title text-center">
                    <h5>There is no product yet</h5>
                </div>';
        }
    }
}
