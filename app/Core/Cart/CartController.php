<?php

namespace App\Core\Cart;

use App\Base\BaseController;
use App\Core\Notification\NotificationService;
use App\Core\Products\Product;
use App\Tier\Inertia\InertiaService;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class CartController extends BaseController {

    public function get_cart() : Response {
        $cart_infos = CartService::get_cart_info();

        $render_params = ["cart_infos" => $cart_infos];

        return InertiaService::render_page('Cart', "CartList", $render_params);
    }



    public function add_to_cart(int $product_id, $quantity = 1) : RedirectResponse {
        $product = Product::find($product_id);

        if (!$product) {
            NotificationService::show_notification("Produit non trouvé !.", NotificationService::TOAST_ERROR);

            return back();
        }

        if ($product->quantity < $quantity) {
            NotificationService::show_notification("Nombre de quantité invalide !.", NotificationService::TOAST_ERROR);

            return back();
        }

        CartService::add_to_cart($product, $quantity);

        NotificationService::show_notification("$quantity produits $product->name ajouté au panier avec succès.");

        return back();
    }



    public function update_cart_product_quantity(int $product_id, $quantity = 1) : RedirectResponse {
        $product = Product::find($product_id);

        if (!$product) {
            NotificationService::show_notification("Produit non trouvé !.", NotificationService::TOAST_ERROR);

            CartService::remove_from_cart($product_id);

            return back();
        }

        if ($product->quantity < $quantity) {
            NotificationService::show_notification("Nombre de quantité invalide !.", NotificationService::TOAST_ERROR);

            return back();
        }

        CartService::update_cart_product_quantity($product, $quantity);

        return back();
    }



    public function remove_from_cart(int $product_id) : RedirectResponse {
        CartService::remove_from_cart($product_id);

        NotificationService::show_notification("Produit supprimé du panier avec succès.");

        return back();
    }

}