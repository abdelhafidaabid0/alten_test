<?php

namespace App\Core\Products;

use App\Base\BaseController;
use App\Tier\Inertia\InertiaService;
use Inertia\Response;

class ProductController extends BaseController {
    public function show_all_products() : Response {
        // Récupérer les produits paginés, par exemple 10 par page
        $products = ProductService::get_products_list();

        $products_statuts_list_select    = ProductService::get_products_status_pour_select();
        $products_categories_list_select = ProductService::get_products_categories_pour_select();
        $products_rating_list_select     = ProductService::get_products_ratings_pour_select();

        $products_active_filtres = session("product_filters", []);

        $render_params = [
            'title'           => "Liste des produits",
            'products'        => $products,
            'active_filters'  => $products_active_filtres,
            'statuts_list'    => $products_statuts_list_select,
            'categories_list' => $products_categories_list_select,
            'rating_list'     => $products_rating_list_select,

        ];

        return InertiaService::render_page("Product", "ProductList", $render_params);
    }

}
