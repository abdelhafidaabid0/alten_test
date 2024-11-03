<?php

namespace App\Core\Products;

use App\Base\BaseController;
use App\Tier\Inertia\InertiaService;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class ProductController extends BaseController {
    public function index() : Response {
        // Récupérer les produits paginés, par exemple 10 par page
        $products = ProductService::get_products_list();

        $products_statuts_list_select    = ProductService::get_products_status_pour_select();
        $products_categories_list_select = ProductService::get_products_categories_pour_select();
        $products_rating_list_select     = ProductService::get_products_ratings_pour_select();

        $products_active_filtres = session("product_filters",[]);

        $render_params = [
            'products'        => $products,
            'active_filters'  => $products_active_filtres,
            'statuts_list'    => $products_statuts_list_select,
            'categories_list' => $products_categories_list_select,
            'rating_list'     => $products_rating_list_select,

        ];

        return InertiaService::render_page("Product", "ProductList", $render_params);
    }



    public function create() : Response {
        $product = new Product();

        $render_params = ['product' => $product];

        return InertiaService::render_page("Product", "ProductDetail", $render_params);
    }



    public function store(StoreProductRequest $request) : RedirectResponse {
        Product::create($request->validated());

        return redirect()
            ->route('products.index')
            ->with('success', 'Product created successfully.');
    }



    public function edit(Product $product) : Response {
        $render_params = ['product' => $product];

        return InertiaService::render_page("Product", "ProductDetail", $render_params);
    }



    public function update(UpdateProductRequest $request, Product $product) : RedirectResponse {
        $product->update($request->validated());

        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated successfully.');
    }



    public function destroy(Product $product) : RedirectResponse {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }

}
